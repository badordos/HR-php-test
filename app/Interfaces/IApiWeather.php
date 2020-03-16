<?php

namespace App\Interfaces;

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