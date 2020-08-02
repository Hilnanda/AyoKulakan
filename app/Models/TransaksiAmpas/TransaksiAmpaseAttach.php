<?php

namespace App\Models\TransaksiAmpas;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Files;
use App\Helpers\HelpersPPOB;
use app\Models\Notification\NotifFeedback;

class TransaksiAmpaseAttach extends Model
{
    protected $table 		= 'trans_ampas_transaksi_attach';
    protected $log_table 	= 'log_trans_ampas_transaksi_attach';
    protected $log_table_fk	= 'log_trans_id';
    protected $fillable 	= [
        'trans_id',
        'filename',
        'fileurl',
        'form_id',
        'form_type',
        'review',
    ];

    
    // public function kereta()
    // {
    //     return $this->morphMany(TransaksiAmpaseKereta::class,'target');
    // }

    public function trans()
    {
        return $this->belongsTo(TransaksiAmpase::class, 'trans_id');
    }

    public function user(){
    	return $this->belongsTo(User::class, 'user_id');
    }

   

   
}
