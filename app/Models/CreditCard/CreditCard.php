<?php

namespace App\Models\CreditCard;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Files;
use App\Models\Attachments;


class CreditCard extends Model
{
    protected $table 		= 'sys_users_credit_card';
    protected $fillable 	= ['user_id','status','no_kartu', 'bulan', 'tahun', 'cvv', 'type_target', 'created_by'];

    public function user()
    {
        return $this->hasOne(User::class, 'user_id');
    }

}
