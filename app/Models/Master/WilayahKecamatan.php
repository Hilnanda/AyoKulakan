<?php

namespace App\Models\Master;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Files;


class WilayahKecamatan extends Model
{
    protected $table 		= 'ref_wilayah_kecamatan';
    protected $fillable 	= ['id','id_negara','id_provinsi','id_kota','kecamatan'];

    public function negara()
    {
        return $this->belongsTo(WilayahNegara::class, 'id_negara');
    }

    public function provinsi()
    {
        return $this->belongsTo(WilayahProvinsi::class, 'id_provinsi');
    }

    public function kota()
    {
        return $this->belongsTo(WilayahKota::class, 'id_kota');
    }
}
