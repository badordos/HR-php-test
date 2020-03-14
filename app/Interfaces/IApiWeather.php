<?php

namespace App\Interfaces;


/**
 * Интерфейс с функциями для подробной информации о заказе
 *
 * Interface IOrderExpandService
 *
 * @package Api\Services\Interfaces\Order
 */
interface IApiWeather
{
    const BRYANSK_LAT = 53.2520900;

    const BRYANSK_LON = 34.3716700;


    /**
     * Запрос к апи
     * @return mixed
     */
    public function request();
}