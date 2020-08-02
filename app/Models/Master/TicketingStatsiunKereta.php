<?php

namespace App\Models\Master;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Files;


class TicketingStatsiunKereta extends Model
{
    protected $table 		= 'ref_destination_kereta';
    protected $fillable 	= [
    	'group_code',
        'code',
        'name',
        'status',
    ];

    public function filesMorphClass()
    {
        return 'ticketing_stasiun_kereta';
    }

    public static function updateOrCreate(array $attributes, array $values = [])
    {
        $instance = $this->firstOrNew($attributes);

        $instance->fill($values);

        $instance->save();

        return $instance;
    }
}
