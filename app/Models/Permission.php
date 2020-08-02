<?php

namespace App\Models;

use App\Models\Model;
use App\Models\User;
use App\Models\Master\Divisi;

use App\Models\Master\JabatanUser;

class Permission extends Model
{
    protected $table 		= 'sys_permissions';
    protected $fillable 	= ['name', 'display_name'];

    public function user()
    {
    	return $this->belongsToMany(RoleAplikasi::class, 'sys_permission_role', 'permission_id', 'role_id');
    }

    public static function getId($string)
    {
        $return = 0;

        $check = Static::where('name', $string)->first();

        if($check)
        {
            $return = $check->id;
        }

        return $return;
    }
}
