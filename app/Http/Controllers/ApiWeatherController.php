<?php

namespace App\Http\Controllers;

use App\Interfaces\IApiWeather;
use Illuminate\Http\Request;

class ApiWeatherController extends Controller
{
    private $apiWeather;

    /**
     * ApiWeatherController constructor.
     */
    public function __construct()
    {
        $this->apiWeather = app()->make(IApiWeather::class);
    }

    /**
     * Страница с погодой
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function weather()
    {
        $data = $this->apiWeather->request();
        return view('weather', ['data' => $data->fact]);
    }
}
