<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    // model
    public function category()
    {
        return $this->belongsTo(RoomCategory::class);
    }
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }


}
