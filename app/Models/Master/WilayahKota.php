<?php

namespace App\Models\Master;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Files;


class WilayahKota extends Model
{
    protected $table 		= 'ref_wilayah_kota';
    protected $fillable 	= ['id','id_negara','id_provinsi','kota'];

    public function provinsi()
    {
        return $this->belongsTo(WilayahProvinsi::class, 'id_provinsi');
    }

    public function negara()
    {
        return $this->belongsTo(WilayahNegara::class, 'id_negara');
    }

    public function kecamatan()
    {
        return $this->hasMany(WilayahKecamatan::class, 'id_kota');
    }

}
