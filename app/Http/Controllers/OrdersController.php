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
        $this->ordersRepo   = RepositoryFactory::makeOrdersRepo();
        $this->productsRepo = RepositoryFactory::makeProductsRepo();
        $this->partnersRepo = RepositoryFactory::makePartnersRepo();
    }

    /**
     * Список заказов
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $allOrders     = $this->ordersRepo->getAllOrders();
        $overdueOrders = $this->ordersRepo->getOverdueOrders();
        $currentOrders = $this->ordersRepo->getCurrentOrders();
        $newOrders     = $this->ordersRepo->getNewOrders();
        $doneOrders    = $this->ordersRepo->getDoneOrders();
        return view('orders.index', compact('allOrders', 'overdueOrders', 'currentOrders', 'newOrders', 'doneOrders'));
    }

    /**
     * Форма редактирования
     * @param Order $order
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Order $order)
    {
        $partners = $this->partnersRepo->getAllPartners();
        $statuses = Order::STATUSES;
        return view('orders.edit', compact('order', 'partners', 'statuses'));
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
