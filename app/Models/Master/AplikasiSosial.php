<?php

namespace App\Models\Master;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Files;


class AplikasiSosial extends Model
{
    protected $table 		= 'ref_aplikasi_sosial';
    protected $fillable 	= ['link','sosial_media'];


}
