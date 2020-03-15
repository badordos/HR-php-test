<?php

namespace App\Repositories;

use App\Partner;
use App\Repositories\Interfaces\IPartnersRepo;

class PartnersRepo implements IPartnersRepo
{
    /**
     * @return Partner[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAllPartners()
    {
        return Partner::all();
    }
}