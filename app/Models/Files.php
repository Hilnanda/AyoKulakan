<?php

namespace App\Models;

use App\Models\Model;
use App\Models\User;

class Files extends Model
{
    protected $table 		= 'sys_files';
    protected $dates 	= ['taken_at'];

    protected $fillable 	= [
        'filename',
        'url',
        'target_type',
        'target_id',
        'type',
        'taken_at'
    ];

    public function target()
    {
        return $this->morphTo();
    }
}
