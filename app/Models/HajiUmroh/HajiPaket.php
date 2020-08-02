<?php

namespace App\Models\HajiUmroh;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Files;
use App\Models\Attachments;


class HajiPaket extends Model
{
    protected $table 		= 'trans_haji_paket';
    protected $fillable 	= ['type_paket', 'keterangan', 'status'];
    protected $log_table    = 'log_trans_haji_paket';
    protected $log_table_fk = 'trans_id';

    public function jadwal(){
    	return $this->hasMany(HajiJadwal::class,'paket_id');
    }
}
