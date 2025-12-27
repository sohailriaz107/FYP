<?php

namespace App\Http\Controllers\User;

use App\Models\Rooms;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HotalController extends Controller
{
    public function index()
    {
        return view('hotal.index');
    }

    public function room()
    {
        $rooms = Rooms::with('roomType')->get();
        return view('hotal.rooms', compact('rooms'));
    }
  public function RoomSingle(Request $request, $id)
{
    $room = Rooms::with(['roomType', 'amenities'])->findOrFail($id);

    // Fetch all other rooms with the same room type
    $sameRooms = Rooms::whereHas('roomType', function ($query) use ($room) {
        $query->where('name', $room->roomType->name);
    })
        ->where('id', '!=', $room->id) // exclude current room
        ->with('images') // eager load images if needed
        ->get();

    return view('hotal.room-single', compact(['room', 'sameRooms'])); // ✅ separate variables
}

    public function Resturent()
    {
        return view('hotal.resturent');
    }
    public function About()
    {
        return view('hotal.about');
    }
    public function Contact()
    {
        return view('hotal.contact');
    }
    public function Profile()
    {
        return view('hotal.profile');
    }
}
