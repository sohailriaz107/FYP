<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    //
    public function Index()
    {
        $bookings = \App\Models\Booking::latest()->get();
        // $booking_status=Booking::where
        return view('admin.booking', compact('bookings'));
    }

    public function UpdateStatus(Request $request, $id)
    {
        $booking = \App\Models\Booking::findOrFail($id);
        $booking->status = $request->status;
        $booking->save();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Booking status updated successfully!',
            ]);
        }

        return redirect()->back()->with('success', 'Booking status updated successfully!');
    }

    public function Destroy($id)
    {
        $booking = \App\Models\Booking::findOrFail($id);
        $booking->delete();

        return response()->json([
            'success' => true,
            'message' => 'Booking deleted successfully!',
        ]);
    }

    public function post(Request $request)
    {
        $request->validate([
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required',
            'room_type' => 'required',
            'room_no' => 'required',
            'base_price' => 'required',
        ]);

        $checkIn = \Carbon\Carbon::parse($request->check_in);
        $checkOut = \Carbon\Carbon::parse($request->check_out);
        $nights = $checkIn->diffInDays($checkOut);

        if ($nights == 0) {
            $nights = 1;
        }

        $totalPrice = $nights * $request->base_price;

        // Backend availability check
        $room = \App\Models\Rooms::where('room_number', $request->room_no)->first();
        
        // Check if room is available in rooms table
        $isAvailableInTable = $room && $room->status === 'available';
        
        // Check for existing active bookings
        $hasExistingBooking = \App\Models\Booking::where('RoomNo', $request->room_no)
            ->whereIn('status', ['pending', 'booked'])
            ->exists();

        if (!$isAvailableInTable || $hasExistingBooking) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, this room is no longer available for booking.',
            ], 422);
        }

        \App\Models\Booking::create([
            'Guest' => \Illuminate\Support\Facades\Auth::user()->name,
            'RoomType' => $request->room_type,
            'RoomNo' => $request->room_no,
            'Check_in' => $request->check_in,
            'Check_out' => $request->check_out,
            'night' => $nights,
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Your booking has been submitted successfully!',
            ]);
        }

        // return redirect()->back()->with('success', 'Your booking has been submitted successfully!');
    }
}
