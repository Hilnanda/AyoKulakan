<?php

namespace App\Models\Berita;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Files;
use App\Models\Attachments;


class Berita extends Model
{
    protected $table 		= 'trans_berita';
    protected $fillable 	= ['judul','deskripsi','kategori', 'status'];

    public function filesMorphClass()
    {
        return 'img_berita';
    }

    public function attachments()
    {
        return $this->morphMany(Attachments::class, 'target')->orderBy('created_at','desc');
    }

}
