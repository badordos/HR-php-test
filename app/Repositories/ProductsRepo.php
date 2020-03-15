<?php

namespace App\Repositories;

use App\Product;
use App\Repositories\Interfaces\IProductsRepo;

class ProductsRepo implements IProductsRepo
{
    public function getAllProducts(){
        return Product::all();
    }
}