<?php

namespace App\Models\HajiUmroh;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Files;
use App\Models\Attachments;


class HajiFeedback extends Model
{
    protected $table 		= 'trans_haji_feedback';
    protected $fillable 	= ['user_id','rating' ,'keterangan', 'status'];
    protected $log_table    = 'log_trans_haji_feedback';
    protected $log_table_fk = 'trans_id';


   
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // public function attachments()
    // {
    //     return $this->morphMany(Attachments::class, 'target');
    // }
}
