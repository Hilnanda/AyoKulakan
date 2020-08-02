<?php

namespace App\Models\Master;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Files;
use App\Models\Attachments;
use App\Models\Master\KategoriBarang;
use App\Models\Barang\LapakBarang;
use App\Models\Lapak\Lapak;

class KategoriBarang extends Model
{
    protected $table 		= 'ref_kategori_barang';
    protected $fillable 	= ['kat_nama'];
    
    public function barang()
    {
        return $this->hasMany(LapakBarang::class);
    }
    public function subkategori()
    {
        return $this->hasMany(KategoriBarangSub::class, 'id_kategori');
    }

    public function filesMorphClass()
    {
        return 'img_kategori_barang';
    }

    public function attachMany()
    {
        return $this->morphMany(Attachments::class, 'target');
    }
    public function lapak()
    {
        return $this->hasMany(Lapak::class, 'id_kategori');
    }
    public function attachments()
    {
        return $this->morphOne(Attachments::class, 'target')->orderBy('created_at','DESC');
    }

}
