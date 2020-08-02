<?php

namespace App\Models\Feedback;

use App\Models\Model;
use App\Models\Roles;
use App\Models\Users;
use App\Models\Files;
use App\Models\Barang\LapakBarang;


class Feedback extends Model
{
    protected $table 		= 'trans_feedback';
    protected $log_table 	= 'log_trans_feedback';
    protected $log_table_fk	= 'trans_id';
    protected $fillable 	= [
    	'form_id',
        'form_type',
        'message',
        'user_id',
        'rate',
        'status',
        'review',
    ];

    public function form()
    {
        return $this->morphTo();
    }

    public function barang(){
        return $this->belongsTo(LapakBarang::class, 'id_barang');
    }

    public function user(){
        return $this->belongsTo(Users::class, 'user_id');
    }

}
