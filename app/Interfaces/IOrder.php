<?php

namespace App\Interfaces;

interface IOrder
{
    const STATUSES = [
        0 => 'Новый заказ',
        10 => 'Подтвержден',
        20 => 'Завершен',
    ];

    public function getId();

    public function getStatus();

    public function getClientEmail();

    public function getPartnerId();

    public function setClientEmail($email);

    public function setPartnerId($id);

    public function setStatus($status);

    public function getDeliveryTime();

    /**
     * Стоимость заказа
     * @return float|int
     */
    public function getSum();

    /**
     * Возвращает все продукты заказа в виде асс.массива
     * @return array
     */
    public function getProductsToArray();

    /**
     * Возвращает массив всех email вендоров заказа
     * @return array
     */
    public function getVendorsEmailToArray();

    //RELATIONS

    public function partner();

    public function products();

}