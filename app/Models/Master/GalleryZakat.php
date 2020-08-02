<?php

namespace App\Models\Master;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Files;
use App\Models\Attachments;


class GalleryZakat extends Model
{
    protected $table 		= 'trans_gallery_zakat';
    protected $fillable 	= ['deskripsi', 'judul'];
    // protected $log_table    = 'log_trans_gallery_photo';
    // protected $log_table_fk = 'id';


    public function filesMorphClass()
    {
        return 'img_gallery_zakat';
    }

    public function attachments()
    {
        return $this->morphMany(Attachments::class, 'target');
    }
}
