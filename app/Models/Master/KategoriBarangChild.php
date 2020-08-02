<?php

namespace App\Models\Master;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Files;


class KategoriBarangChild extends Model
{
    protected $table 		= 'ref_kategori_barang_child';
    protected $fillable 	= ['nama','id_sub_kategori'];

    public function subkategori()
    {
        return $this->belongsTo(KategoriBarangSub::class, 'id_sub_kategori');
    }

}
