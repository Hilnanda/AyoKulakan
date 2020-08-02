<?php

namespace App\Models\HajiUmroh;

use App\Models\Model;
// use App\Models\Model\HajiUmroh\HajiPaket;
// use App\Models\Model\HajiUmroh\HajiJadwal;

use App\Models\Roles;
use App\Models\User;
use App\Models\Files;
use App\Models\Attachments;


class HajiDaftar extends Model
{
    protected $table 		= 'trans_haji_daftar';
    protected $fillable 	= ['user_id', 'id_paket', 'id_jadwal', 'nik', 'kk', 'keterangan_penyakit', 'status','name','passport'];
    protected $log_table    = 'log_trans_haji_daftar';
    protected $log_table_fk = 'trans_id';


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function paket()
    {
        return $this->belongsTo(HajiPaket::class, 'id_paket');
    }

    public function jadwal()
    {
        return $this->belongsTo(HajiJadwal::class, 'id_jadwal');
    }

    public function filesMorphClass()
    {
        return 'img_daftar_haji';
    }
    
    public function attachments()
    {
        return $this->morphMany(Attachments::class, 'target');
    }

    public function statusLabel()
    {
        switch($this->status) {
            case 1 : return '<span class="badge badge-secondary">Belum Lunas</span>';
            break;
            case 2 : return '<span class="badge badge-secondary">Sudah Lunas</span>';
            break;
            case 3 : return '<span class="badge badge-secondary">Hold</span>';
            break;
            case 4 : return '<span class="badge badge-secondary">Cancle</span>';
            break;
        }
    }

}
