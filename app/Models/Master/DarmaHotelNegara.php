<?php

namespace App\Models\Master;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Files;


class DarmaHotelNegara extends Model
{
    protected $table         = 'ref_darma_hotel_negara';
    protected $fillable     = [
    	'code', 
    	'name'
    ];

    public function kota()
    {
        return $this->hasMany(DarmaHotelKota::class, 'id_negara');
    }
}
