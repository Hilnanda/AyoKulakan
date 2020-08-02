<?php

namespace App\Models\Master;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Files;
use App\Models\Attachments;


class KategoriBarangSub extends Model
{
    protected $table 		= 'ref_kategori_barang_sub';
    protected $fillable 	= ['id_kategori','sub_nama'];

    public function kategori()
    {
        return $this->belongsTo(KategoriBarang::class, 'id_kategori');
    }

    public function childkategori()
    {
        return $this->hasMany(KategoriBarangChild::class, 'id_sub_kategori');
    }

    public function filesMorphClass()
    {
        return 'img_sub_kategori_barang';
    }

    public function attachMany()
    {
        return $this->morphMany(Attachments::class, 'target');
    }

    public function attachments()
    {
        return $this->morphOne(Attachments::class, 'target')->orderBy('created_at','DESC');
    }
}
