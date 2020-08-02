<?php

namespace App\Models;

use App\Models\Model;
use App\Models\User;
use App\Models\Master\Divisi;
use App\Models\Master\TopikPelatihan;

use App\Models\Master\JabatanUser;
use App\Models\Training\PelatihanJabatan;
use App\Models\Training\PelatihanUser;

class Roles extends Model
{
    protected $table 		= 'sys_roles';
    protected $fillable 	= ['name', 'display_name', 'description'];

    public function permission()
    {
        return $this->belongsToMany(Permission::class, 'sys_permission_role', 'role_id', 'permission_id');
    }



}
