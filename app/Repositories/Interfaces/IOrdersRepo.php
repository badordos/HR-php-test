<?php

namespace App\Repositories\Interfaces;

use App\Order;

interface IOrdersRepo
{
    const STATUS_CONFIRMED = 20;

    /**
     * @return Order[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAllOrders();

}