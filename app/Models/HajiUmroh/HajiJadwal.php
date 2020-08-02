<?php

namespace App\Models\HajiUmroh;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Files;
use App\Models\Attachments;


class HajiJadwal extends Model
{
    protected $table 		= 'trans_haji_jadwal';
    protected $fillable 	= ['paket_id','judul', 'tgl_berangkat', 'tgl_pulang', 'total_hari', 'keterangan', 'harga', 'status'];
    protected $log_table    = 'log_trans_haji_jadwal';
    protected $log_table_fk = 'trans_id';


    // public function filesMorphClass()
    // {
    //     return 'img_gallery_haji';
    // }

    // public function attachments()
    // {
    //     return $this->morphMany(Attachments::class, 'target');
    // }

    public function paket(){
        return $this->belongsTo(HajiPaket::class,'paket_id');
    }
}
