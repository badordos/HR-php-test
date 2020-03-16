<?php

namespace App\Repositories;

use App\Events\OrderStatusIsConfirmed;
use App\Http\Requests\OrderUpdateRequest;
use App\Interfaces\IOrder;
use App\Notifications\OrderStatusConfirmedNotification;
use App\Order;
use App\Repositories\Interfaces\IOrdersRepo;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class OrdersRepo implements IOrdersRepo
{
    /**
     * @return Order[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAllOrders()
    {
        return Order::all();
    }

    /**
     * Просроченные заказы:
     * дата доставки раньше текущего момента
     * статус заказа 10
     * сортировка по дате доставки по убыванию
     * ограничение 50 штук
     * @return Collection
     */
    public function getOverdueOrders()
    {
        return Order::where('status', 10)->where('delivery_dt', '<=', Carbon::now())
            ->limit(50)->get()->sortBy('delivery_dt');
    }

    /**
     * Текущие заказы:
     * дата доставки 24 часа с текущего момента
     * статус заказа 10
     * сортировка по дате доставки по возрастанию
     * @return Collection
     */
    public function getCurrentOrders()
    {
        return Order::where('status', 10)->whereBetween('delivery_dt', [Carbon::now(), Carbon::now()->addDay()])
            ->get()->sortByDesc('delivery_dt');
    }

    /**
     * Новые заказы:
     * дата доставки после текущего момента
     * статус заказа 0
     * сортировка по дате доставки по возрастанию
     * ограничение 50
     * @return Collection
     */
    public function getNewOrders()
    {
        return Order::where('status', 0)->where('delivery_dt', '>', Carbon::now())
            ->limit(50)->get()->sortByDesc('delivery_dt');
    }

    /**
     * Завершенные заказы:
     * дата доставки в текущие сутки
     * статус заказа 20
     * сортировка по дате доставки по убыванию
     * ограничение 50
     * @return Collection
     */
    public function getDoneOrders()
    {
        return Order::where('status', 20)->whereBetween('delivery_dt', [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()])
            ->limit(50)->get()->sortBy('delivery_dt');
    }

    /**
     * Обновить из формы редактирования
     * @param IOrder $order
     * @param OrderUpdateRequest $request
     * @return bool
     */
    public function updateFromForm(IOrder $order, OrderUpdateRequest $request)
    {
        $order->setClientEmail($request->client_email);
        $order->setPartnerId($request->partner);
        if ($order->getStatus() != $request->status && $request->status == self::STATUS_CONFIRMED) {
            $order->notify(new OrderStatusConfirmedNotification($order));
        }
        $order->setStatus($request->status);
        $this->syncProductsQuantity($order, $request->products);
        return $order->update();
    }

    /**
     * Синхронизация отношения с продуктом
     *
     * @param IOrder $order
     * @param array $products
     */
    public function syncProductsQuantity(IOrder $order, array $products)
    {
        $order->products()->sync($products);
    }

}