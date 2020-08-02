<?php

namespace App\Models\Master;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Files;


class AplikasiTentang extends Model
{
    protected $table 		= 'ref_aplikasi_tentang';
    protected $fillable 	= ['judul','deskripsi','kategori','email','phone','fax'];


}
