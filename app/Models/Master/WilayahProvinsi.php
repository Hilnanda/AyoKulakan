<?php

namespace App\Models\Master;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Files;


class WilayahProvinsi extends Model
{
    protected $table         = 'ref_wilayah_provinsi';
    protected $fillable     = ['id_negara', 'provinsi'];

    protected $hidden = ['created_at', 'updated_at', 'created_by', 'updated_by'];
    public function Users()
    {
        return hasMany(User::class, 'id_provinsi');
    }

    public function negara()
    {
        return $this->belongsTo(WilayahNegara::class, 'id_negara');
    }

    public function kota()
    {
        return $this->hasMany(WilayahKota::class, 'id_provinsi');
    }
}
