<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


//============== Meaning ==============================================
$room=[
    'booked_room'=>'booked room mean is_booked is 1',
    'unbooked_room'=>'unbooked room mean is_booked is 0 and NULL',
    'inactive'=>'inactive room mean room_status is 0 ',
    'active'=>'active room mean room_status is 1 and Null ',
    ];
 // ========== Meaning ============================================

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
