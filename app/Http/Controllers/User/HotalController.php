<?php

namespace App\Http\Controllers\User;

use App\Models\Rooms;
use App\Http\Controllers\Controller;
use App\Models\RoomsTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class HotalController extends Controller
{
    public function index()
    {
        $rooms = Rooms::with(['roomType', 'images'])->get();
        $room_type=RoomsTypes::all();
        $testimonials = \App\Models\Review::with('user')->latest()->limit(6)->get();
        if(Auth::user()->role=='user'){
return view('hotal.index',compact('rooms','room_type', 'testimonials'));
        }
         // Optional: redirect others (admin or guest) somewhere
    return redirect()->route('dashboard');
        
    }

    public function room()
    {
        $rooms = Rooms::with(['roomType', 'images'])->get();
        $room_types = RoomsTypes::all();
        return view('hotal.rooms', compact('rooms', 'room_types'));
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

        // Check if the room is already booked by ANYONE (pending or booked status)
        $isRoomBooked = \App\Models\Booking::where('RoomNo', $room->room_number)
            ->whereIn('status', ['pending', 'booked'])
            ->exists();

        // Fetch reviews for this room
        $reviews = \App\Models\Review::where('room_id', $id)->with('user')->latest()->get();
        $averageRating = $reviews->avg('rating');

        return view('hotal.room-single', compact('room', 'sameRooms', 'bookingStatus', 'reviews', 'averageRating', 'isRoomBooked'));
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
        $admin = \App\Models\User::where('role', 'admin')->first();
        return view('hotal.contact', compact('admin'));
    }
    public function Profile()
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        $booking = \App\Models\Booking::where('Guest', $user->name)
            ->with(['room.roomType', 'room.images'])
            ->latest()
            ->first();
            
        return view('hotal.profile', compact('user', 'booking'));
    }

    public function CancelBooking($id)
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        $booking = \App\Models\Booking::where('id', $id)
            ->where('Guest', $user->name)
            ->first();

        if (!$booking) {
            return response()->json([
                'status' => 'error',
                'message' => 'Booking not found.'
            ], 404);
        }

        $booking->status = 'cancelled';
        $booking->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Booking cancelled successfully!'
        ]);
    }

    public function UpdateProfile(Request $request)
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($user->image && file_exists(public_path($user->image))) {
                @unlink(public_path($user->image));
            }
            
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('uploads/profile'), $imageName);
            $user->image = 'uploads/profile/'.$imageName;
        }

        if ($request->filled('new_password')) {
            if (!\Illuminate\Support\Facades\Hash::check($request->current_password, $user->password)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Current password does not match.'
                ], 400);
            }
            $user->password = \Illuminate\Support\Facades\Hash::make($request->new_password);
        }

        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Profile updated successfully!',
            'user' => $user
        ]);
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
            ->with(['roomType', 'images'])
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
