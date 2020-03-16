<?php

namespace App\Interfaces;

interface IProduct
{
    public function getId();

    public function getName();

    public function getPrice();

    public function setPrice($price);

    //RELATIONS

    public function vendor();
}