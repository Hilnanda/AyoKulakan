<?php

namespace App\Models\TransaksiAmpas;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Files;


class FormsTransaksiRealtion extends Model
{
    protected $table 		= 'forms';
    protected $fillable 	= [
        'id',
        'form_id',
        'form_type',
    ];

}
