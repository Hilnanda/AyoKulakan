<?php

namespace App\Models\Master;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Files;


class DarmaHotelKota extends Model
{
    protected $table         = 'ref_darma_hotel_kota';
    protected $fillable     = [
    	'id_negara', 
    	'code', 
    	'name'
    ];

}
