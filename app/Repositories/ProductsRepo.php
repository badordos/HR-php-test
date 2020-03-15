<?php

namespace App\Repositories;

use App\Product;
use App\Repositories\Interfaces\IProductsRepo;
use App\Vendor;
use Illuminate\Http\Request;

class ProductsRepo implements IProductsRepo
{
    public $paginate = 25;

    public function getById($id)
    {
        return Product::find($id);
    }

    /**
     * Все продукты
     * @return Product[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAllProducts()
    {
        return Product::all();
    }

    /**
     * Продукты с поставщиками сортированные по имени с пагинацией
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllProductsWithVendorSortByNamePaginate()
    {
        return Product::with('vendor')->orderBy('name')->paginate($this->paginate);
    }

    /**
     * Обновляем ценник
     * @param Request $request
     * @return mixed
     */
    public function updatePrice(Request $request)
    {
        $product = $this->getById($request->id);
        $product->setPrice($request->price);
        return $product->update();
    }
}