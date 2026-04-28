<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Mail\BookingConfirmationMail;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;

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

        $recipientEmail = $booking->email;
        if (!$recipientEmail) {
            $user = \App\Models\User::where('name', $booking->Guest)->first();
            $recipientEmail = $user ? $user->email : null;
        }

        if ($recipientEmail) {
            try {
                Mail::to($recipientEmail)->send(new \App\Mail\MailBookRoom($booking));
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Mail sending failed: ' . $e->getMessage());
            }
        }

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
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please login first'
            ], 401);
        }

        $validator = Validator::make($request->all(), [
            'check_in'   => 'required|date|after_or_equal:today',
            'check_out'  => 'required|date|after:check_in',
            'guests'     => 'required',
            'room_type'  => 'required',
            'room_no'    => 'required',
            'base_price' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
                'errors'  => $validator->errors()
            ], 422);
        }

        $checkIn  = Carbon::parse($request->check_in);
        $checkOut = Carbon::parse($request->check_out);
        $nights   = $checkIn->diffInDays($checkOut);

        if ($nights < 1) {
            return response()->json([
                'success' => false,
                'message' => 'Check-out date must be at least 1 night after check-in.'
            ], 422);
        }

        // Check if this room is already booked for the specified dates (pending or confirmed)
        $alreadyBooked = Booking::where('RoomNo', $request->room_no)
            ->whereIn('status', ['pending', 'booked'])
            ->where(function ($query) use ($checkIn, $checkOut) {
                // Determine Date overlapping logic
                $query->where('Check_in', '<', $checkOut)
                      ->where('Check_out', '>', $checkIn);
            })
            ->exists();

        if ($alreadyBooked) {
            return response()->json([
                'success' => false,
                'message' => 'This room is already booked for the selected dates. Please choose different dates or another room.'
            ], 422);
        }

        $totalPrice = $nights * $request->base_price;

        $booking = Booking::create([
            'Guest'       => Auth::user()->name,
            'email'       => Auth::user()->email,
            'RoomType'    => $request->room_type,
            'RoomNo'      => $request->room_no,
            'Check_in'    => $request->check_in,
            'Check_out'   => $request->check_out,
            'night'       => $nights,
            'total_price' => $totalPrice,
            'status'      => 'pending'
        ]);

        try {
            Mail::to(Auth::user()->email)->send(new BookingConfirmationMail($booking));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Mail sending failed: ' . $e->getMessage());
        }

        return response()->json([
            'success' => true,
            'message' => 'Booking successful! Your booking is pending confirmation.'
        ]);
    }

    /**
     * Download PDF Invoice for a booking.
     * Accessible by: Admin (any booking) or User (own booking only)
     */
    public function downloadInvoice($id)
    {
        $booking = Booking::findOrFail($id);

        // Security: non-admin users can only download their own booking invoice
        if (Auth::user()->role !== 'admin') {
            if ($booking->email !== Auth::user()->email) {
                abort(403, 'Unauthorized access to this invoice.');
            }
        }

        $admin = \App\Models\User::where('role', 'admin')->first();

        $pdf = Pdf::loadView('pdf.booking_invoice', compact('booking', 'admin'))
            ->setPaper('a4', 'portrait')
            ->setOptions([
                'dpi'                    => 150,
                'defaultFont'            => 'DejaVu Sans',
                'isHtml5ParserEnabled'   => true,
                'isRemoteEnabled'        => false,
            ]);

        $filename = 'StayEase-Invoice-' . str_pad($booking->id, 6, '0', STR_PAD_LEFT) . '.pdf';

        return $pdf->download($filename);
    }
}
