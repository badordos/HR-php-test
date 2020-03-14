<?php

namespace App\Classes;

use App\Interfaces\IApiWeather;

/**
 * Class ApiWeather
 * @package App\Classes
 */
class ApiWeather implements IApiWeather
{
    const YANDEX_WEATHER_HOST = 'https://api.weather.yandex.ru/v1/forecast?';

    const YANDEX_LANG = 'ru_RU';

    const YANDEX_LIMIT = 1;

    private $host;

    private $apiKey;

    private $options = [];

    /**
     * ApiWeather constructor.
     */
    public function __construct()
    {
        $this->host   = self::YANDEX_WEATHER_HOST;
        $this->apiKey = config('apikeys')['yandex.weather'];
        $this->prepare();
    }

    /**
     * подготовка опций запроса
     * @return void
     */
    private function prepare()
    {
        $this->options['lat']   = self::BRYANSK_LAT;
        $this->options['lon']   = self::BRYANSK_LON;
        $this->options['lang']  = self::YANDEX_LANG;
        $this->options['limit'] = self::YANDEX_LIMIT;
    }

    /**
     * Запрос к апи
     * @return mixed
     */
    public function request()
    {
        $url = $this->host . http_build_query($this->options);
        return json_decode($this->curl_get($url));
    }

    /**
     * Получение данных с помощью curl
     * @param string $url
     * @return mixed
     */
    private function curl_get($url)
    {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'X-Yandex-API-Key: ' . $this->apiKey
        ]);
        curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);

        $result = curl_exec($curl);
        curl_error($curl);
        curl_close($curl);

        return $result;
    }
}
