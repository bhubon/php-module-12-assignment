<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = ['from_location_id', 'to_location_id', 'departure_date', 'return_date', 'price_per_seat'];

    public function fromLocation()
    {
        return $this->belongsTo(Location::class, 'from_location_id', 'id');
    }
    public function toLocation()
    {
        return $this->belongsTo(Location::class, 'to_location_id', 'id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
