<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Canteen extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'room_id',
        'startdate',
        'enddate',
        'amount',
    ];
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
