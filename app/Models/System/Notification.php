<?php

namespace App\Models\System;

use App\Models\Model;
use App\Models\User;
use App\Models\Roles;
use App\Models\Audit\DataAudit;

// use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    // use SoftDeletes;

    protected $table 		= 'hse_trans_notification';
    protected $fillable 	= ['url','status','content','user_id'];

}
