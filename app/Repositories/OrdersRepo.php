<?php

namespace App\Repositories;

use App\Http\Requests\OrderUpdateRequest;
use App\Order;
use App\Repositories\Interfaces\IOrdersRepo;

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
     * Обновить из формы редактирования
     * @param Order $order
     * @param OrderUpdateRequest $request
     * @return bool
     */
    public function updateFromForm(Order $order, OrderUpdateRequest $request)
    {
        $order->setClientEmail($request->client_email);
        $order->setPartnerId($request->partner);
        $order->setStatus($request->status);
        $this->syncProductsQuantity($order, $request->products);
        return $order->update();
    }

    /**
     * Синхронизация отношения с продуктом
     *
     * @param Order $order
     * @param array $products
     */
    public function syncProductsQuantity(Order $order, array $products)
    {
        $order->products()->sync($products);
    }

}