<?php

namespace App\Models\Master;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Files;


class PPOBPdam extends Model
{
    protected $table 		= 'ref_ppob_pdam_provider';
    protected $fillable 	= [
    	'code',
        'name',
        'fee',
        'komisi',
        'type',
        'status',
        'province',
    ];

    public function filesMorphClass()
    {
        return 'ppob_pdam';
    }

    public static function updateOrCreate(array $attributes, array $values = [])
    {
        $instance = $this->firstOrNew($attributes);

        $instance->fill($values);

        $instance->save();

        return $instance;
    }
}
