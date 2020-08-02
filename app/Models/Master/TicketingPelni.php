<?php

namespace App\Models\Master;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Files;


class TicketingPelni extends Model
{
    protected $table 		= 'ref_dest_pelni';
    protected $fillable 	= [
    	'name',
        'code',
    ];

    public function filesMorphClass()
    {
        return 'ticketing_pelni';
    }

    public static function updateOrCreate(array $attributes, array $values = [])
    {
        $instance = $this->firstOrNew($attributes);

        $instance->fill($values);

        $instance->save();

        return $instance;
    }
}
