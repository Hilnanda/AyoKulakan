<?php

namespace App\Models\Master;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Files;
use App\Models\Attachments;

class KategoriRental extends Model
{
    protected $table 		= 'ref_kategori_rental';
    protected $fillable 	= ['nama'];

    public function subkategori()
    {
        return $this->hasMany(KategoriRentalSub::class, 'trans_kategori_id');
    }

    public function filesMorphClass()
    {
        return 'img_kategori_rental';
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
