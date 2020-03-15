<?php

namespace App\Repositories\Interfaces;

use App\Order;

interface IOrdersRepo
{
    /**
     * @return Order[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAllOrders();

}