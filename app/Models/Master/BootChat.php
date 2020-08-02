<?php

namespace App\Models\Master;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Files;


class BootChat extends Model
{
    protected $table 		= 'ref_boot_chat';
    protected $fillable 	= ['name'];


}
