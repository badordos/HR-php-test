<?php

namespace App;

use App\Interfaces\IProduct;
use Illuminate\Database\Eloquent\Model;

class Product extends Model implements IProduct
{
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    //RELATIONS

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id', 'id');
    }
}
