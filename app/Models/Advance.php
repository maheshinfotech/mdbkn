<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Advance extends Model
{
    protected $table = 'advances'; // Set the table name if it's different from the default

    protected $fillable = ['booking_id', 'amount', 'received_date'];

    // Define the relationships if needed
    // For example, if you have a relationship with the Booking model:
        public function booking()
        {
            return $this->belongsTo(Booking::class, 'booking_id');
        }
        
}
