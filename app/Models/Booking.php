<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'trip_id', 'total'];

    public function seats()
    {
        return $this->hasMany(SeatAllocation::class, 'booking_id', 'id');
    }

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }
}
