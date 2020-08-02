<?php

namespace App\Models\Master;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Files;


class TicketingAirport extends Model
{
    protected $table         = 'ref_airport';
    protected $fillable     = [
        'airport_name',
        'airport_code',
        'location_name',
        'country_id',
        'country_name',
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'created_by', 'updated_by'
    ];

    public function filesMorphClass()
    {
        return 'ticketing_airport';
    }

    public static function updateOrCreate(array $attributes, array $values = [])
    {
        $instance = $this->firstOrNew($attributes);

        $instance->fill($values);

        $instance->save();

        return $instance;
    }
}
