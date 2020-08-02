<?php

namespace App\Models\Master;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Files;


class AplikasiPanduan extends Model
{
    protected $table 		= 'ref_aplikasi_panduan';
    protected $fillable 	= ['judul','deskripsi','kategori'];


}
