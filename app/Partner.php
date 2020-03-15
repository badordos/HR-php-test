<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }
}
