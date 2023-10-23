<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomCategory extends Model
{
    public function comments()
    {
        return $this->hasMany(Room::class);
    }
}
