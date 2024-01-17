<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;

    protected $table = 'wards';

    protected $fillable = [
        'hospital_id',
        'ward',

    ];

    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }
}
