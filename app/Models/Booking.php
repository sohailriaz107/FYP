<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'table_booking';
    protected $fillable = [
        'Guest',
        'RoomType',
        'RoomNo',
        'Check_in',
        'Check_out',
        'night',
        'total_price',
        'status',
    ];

    public function room()
    {
        return $this->belongsTo(Rooms::class, 'RoomNo', 'room_number');
    }
}
