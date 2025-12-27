<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomsTypes extends Model
{
    //
    protected $fillable = [
        'name',
        'base_price',
        'description',
        'beds',
        'room_size',
        'max_persons'
    ];

    protected $table = "room_types";

      
    public function rooms()
    {
        return $this->hasMany(Rooms::class);
    }

}
