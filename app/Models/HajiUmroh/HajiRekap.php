<?php

namespace App\Models\HajiUmroh;

use App\Models\Model;

use App\Models\Roles;
use App\Models\User;
use App\Models\Files;
use App\Models\Attachments;


class HajiRekap extends Model
{
    protected $table 		= 'trans_haji_rekap_angsuran';
    protected $fillable 	= ['user_id', 'tgl_pembayaran', 'uang_pembayaran', 'order_id', 'status'];
    protected $log_table    = 'log_trans_haji_rekap_angsuran';
    protected $log_table_fk = 'trans_id';

    
    public function setTglPembayaranAttribute($value)
    {
        $this->attributes['tgl_pembayaran'] = DateToSql($value);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function filesMorphClass()
    {
        return 'img_angsuran_haji';
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
