<?php

namespace App;

use App\Interfaces\IPartner;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model implements IPartner
{
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }
}
