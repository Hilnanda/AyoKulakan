<?php

namespace App\Models\Master;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Files;


class KategoriRentalSub extends Model
{
    protected $table 		= 'ref_sub_kategori_rental';
    protected $fillable 	= ['nama','trans_kategori_id'];

    public function kategori(){
    	return $this->belongsTo(KategoriRental::class, 'trans_kategori_id');
    }
}
