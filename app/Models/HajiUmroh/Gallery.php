<?php

namespace App\Models\HajiUmroh;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Files;
use App\Models\Attachments;


class Gallery extends Model
{
    protected $table 		= 'trans_gallery_photo';
    protected $fillable 	= ['deskripsi', 'status'];
    protected $log_table    = 'log_trans_gallery_photo';
    protected $log_table_fk = 'id';


    public function filesMorphClass()
    {
        return 'img_gallery_haji';
    }

    public function attachments()
    {
        return $this->morphMany(Attachments::class, 'target')->orderBy('created_at','desc');
    }
}
