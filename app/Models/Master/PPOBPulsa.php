<?php

namespace App\Models\Master;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Files;


class PPOBPulsa extends Model
{
    protected $table 		= 'ref_ppob_pulsa';
    protected $fillable 	= [
    	'pulsa_code',
		'pulsa_op',
		'pulsa_nominal',
		'pulsa_price',
		'pulsa_type',
		'status',
		'masaaktif',
    ];

    public function filesMorphClass()
    {
        return 'list_ppob';
    }

    public function updateOrCreate(array $attributes, array $values = [])
    {
        $instance = $this->firstOrNew($attributes);

        $instance->fill($values);

        $instance->save();

        return $instance;
    }
}
