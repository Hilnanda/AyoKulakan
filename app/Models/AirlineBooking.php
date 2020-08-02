<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AirlineBooking extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'airline_bookings';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Get the user that owns the airline_bookings.
     */
    public function user()
    {
        return $this->belongsTo(Users::class, 'user_id');
    }
}
