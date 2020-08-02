<?php

namespace App\Models\HajiUmroh;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Files;
use App\Models\Attachments;


class BeritaTerbaru extends Model
{
    protected $table 		= 'trans_berita_terbaru';
    protected $fillable 	= ['judul','deskripsi','kategori', 'status'];


    public function filesMorphClass()
    {
        return 'img_berita_haji';
    }

    public function attachments()
    {
        return $this->morphMany(Attachments::class, 'target')->orderBy('created_at','desc');
    }
}
