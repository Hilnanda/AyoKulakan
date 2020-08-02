<?php

namespace App\Models;

use App\Models\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class Attachments extends Model
{
    protected $table 		= 'sys_attachments';
    protected $dates    = ['taken_at'];

    protected $fillable 	= [
        'filename',
        'url',
        'target_type',
        'target_id',
        'type',
        'taken_at'
    ];
    
    public static function boot()
    {
        parent::boot();
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('created_at', 'desc');
        });
    }

    public function target()
    {
        return $this->morphTo();
    }
}
