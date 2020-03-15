<?php

namespace App\Factories;

use App\Repositories\Interfaces\IOrdersRepo;
use App\Repositories\Interfaces\IPartnersRepo;
use App\Repositories\Interfaces\IProductsRepo;

class RepositoryFactory
{
    public static function makeOrdersRepo(): IOrdersRepo
    {
        return app()->make(IOrdersRepo::class);
    }

    public static function makeProductsRepo(): IProductsRepo
    {
        return app()->make(IProductsRepo::class);
    }

    public static function makePartnersRepo(): IPartnersRepo
    {
        return app()->make(IPartnersRepo::class);
    }

}