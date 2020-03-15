<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    public function getName()
    {
        return $this->name;
    }
}
