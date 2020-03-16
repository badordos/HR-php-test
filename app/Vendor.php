<?php

namespace App;

use App\Interfaces\IVendor;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model implements IVendor
{
    public function getName()
    {
        return $this->name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }
}
