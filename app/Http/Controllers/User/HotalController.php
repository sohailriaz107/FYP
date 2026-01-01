<?php

namespace App\Http\Controllers\User;

use App\Models\Rooms;
use App\Http\Controllers\Controller;
use App\Models\RoomsTypes;
use Illuminate\Http\Request;

class HotalController extends Controller
{
    public function index()
    {
        $rooms = Rooms::with('roomType')->get();
        $room_type=RoomsTypes::all();
        return view('hotal.index',compact('rooms','room_type'));
    }

    public function room()
    {
        $rooms = Rooms::with('roomType')->get();
        return view('hotal.rooms', compact('rooms'));
    }
    public function RoomSingle(Request $request, $id)
    {
        $room = Rooms::with(['roomType', 'amenities', 'images'])->findOrFail($id);

        // Fetch all other rooms with the same room type ID
        $sameRooms = Rooms::where('room_type_id', $room->room_type_id)
            ->where('id', '!=', $room->id) // exclude current room
            ->with(['roomType', 'images']) // eager load roomType for price and images
            ->limit(4) // limit to 4 rooms for better UI
            ->get();

        $booking = \App\Models\Booking::where('RoomNo', $room->room_number)
            ->where('RoomType', $room->roomType->name)
            ->where('Guest', \Illuminate\Support\Facades\Auth::user()->name)
            ->latest()
            ->first();
        $bookingStatus = $booking ? $booking->status : null;

        return view('hotal.room-single', compact('room', 'sameRooms', 'bookingStatus'));
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

    public function checkAvailability(Request $request)
    {
        $request->validate([
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'room_type' => 'required|exists:room_types,id',
        ]);

        $checkIn = $request->check_in;
        $checkOut = $request->check_out;
        $roomTypeId = $request->room_type;

        // Find available rooms of the selected type
        $availableRooms = Rooms::where('room_type_id', $roomTypeId)
            ->whereDoesntHave('bookings', function ($query) use ($checkIn, $checkOut) {
                $query->where(function ($q) use ($checkIn, $checkOut) {
                    $q->where('Check_in', '<', $checkOut)
                      ->where('Check_out', '>', $checkIn);
                })->where('status', '!=', 'cancelled');
            })
            ->get();

        if ($availableRooms->isNotEmpty()) {
            $html = '';
            foreach ($availableRooms as $room) {
                $html .= view('hotal.partials.room_card', compact('room'))->render();
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Rooms are available!',
                'available_count' => $availableRooms->count(),
                'html' => $html
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'No rooms available for the selected dates and type.'
        ]);
    }
}
