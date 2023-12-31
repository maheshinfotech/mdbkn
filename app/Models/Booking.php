<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Room;
use App\Models\Advance;
use App\Models\BookingLogs;
use App\Models\hospital;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

   
    
    public function getCheckInTimeAttribute($value){
        if ($value){
            return Carbon::parse($value)->format('h:i A');
        }
        return '--';
    }

    public function getCheckOutTimeAttribute($value){
        if ($value){
            return Carbon::parse($value)->format('h:i A');
        }
        return "--";
    }

    // public function room(){
    //     return $this->belongsTo(Room::class)->with('category');
    // }
    // return "--";
    // }

    public function bookinglogs() {
        return $this->hasMany(BookingLogs::class);
    }

    public function room(){
        return $this->belongsTo(Room::class)->with('category');
    }
    
    // public function rooms()
    // {
    //     return $this->belongsTo(Room::class, 'room_id');
    // }

    public function advance()
    {
        return $this->hasMany(Advance::class);
    }
 
  
}