<?php

namespace App\Http\Controllers;

use App\Factories\RepositoryFactory;
use App\Http\Requests\OrderUpdateRequest;
use App\Order;

class OrdersController extends Controller
{
    public $ordersRepo;
    public $productsRepo;
    public $partnersRepo;

    public function __construct()
    {
        $this->ordersRepo = RepositoryFactory::makeOrdersRepo();
        $this->productsRepo = RepositoryFactory::makeProductsRepo();
        $this->partnersRepo = RepositoryFactory::makePartnersRepo();
    }

    /**
     * Список заказов
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $orders = $this->ordersRepo->getAllOrders();
        return view('orders.index', compact('orders'));
    }

    /**
     * Форма редактирования
     * @param Order $order
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Order $order)
    {
        $products = $this->productsRepo->getAllProducts();
        $partners = $this->partnersRepo->getAllPartners();
        $statuses = Order::STATUSES;
        return view('orders.edit', compact('order', 'products', 'partners', 'statuses'));
    }

    /**
     * Обновление заказа
     * @param Order $order
     * @param OrderUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Order $order, OrderUpdateRequest $request)
    {
        $this->ordersRepo->updateFromForm($order, $request);
        return redirect(route('orders.index'))->with('message', 'Заказ ' . $order->getId() . ' обновлен');
    }
}
