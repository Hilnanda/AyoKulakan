<?php

namespace App\Models\Master;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Files;


class WilayahNegara extends Model
{
    protected $table         = 'ref_wilayah_negara';
    protected $fillable     = ['negara', 'area_id', 'area_code'];

    protected $hidden = ['created_at', 'updated_at', 'created_by', 'updated_by'];

    public function provinsi()
    {
        return $this->hasMany(WilayahProvinsi::class, 'id_provinsi');
    }
}
