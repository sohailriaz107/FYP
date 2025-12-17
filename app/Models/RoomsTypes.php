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
];
protected $table="room_types";
}
