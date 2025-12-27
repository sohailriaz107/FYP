<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    //
     protected $fillable = [
        'room_type_id',
        'room_number',
        'status'
    ];

    public function roomType()
    {
        return $this->belongsTo(RoomsTypes::class, 'room_type_id');
    }

    protected $table = "rooms";

     public function amenities()
    {
        return $this->belongsToMany(Amenities::class, 'amenity_rooms', 'rooms_id', 'amenities_id');
    }

    public function images()
    {
        return $this->hasMany(RoomImage::class, 'room_id');
    }
}
