<?php

namespace App\Http\Controllers;

use App\Factories\RepositoryFactory;
use Illuminate\Http\Request;


class ProductsController extends Controller
{
    public $productsRepo;

    public function __construct()
    {
        $this->productsRepo = RepositoryFactory::makeProductsRepo();
    }

    /**
     * Список продуктов
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $products = $this->productsRepo->getAllProductsWithVendorSortByNamePaginate();
        return view('products.index', compact('products'));
    }

    /**
     * Обновление цены
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $validate = $request->validate([
            'price' => 'required|numeric',
            'id' => 'required|numeric',
        ]);

        if (!$validate) {
            $data['status'] = 'error';
            $data['message'] = 'Ошибка валидации';
            return $this->jsonResponse($data);
        }

        $upd = $this->productsRepo->updatePrice($request);

        $data['status'] = $upd ? 'success' : 'error';
        $data['message'] = $upd ? 'Обновление успешно' : 'Обновление неудачно. Обратитесь к администратору';
        $data['new_price'] = $request->price;

        return $this->jsonResponse($data);
    }
}
