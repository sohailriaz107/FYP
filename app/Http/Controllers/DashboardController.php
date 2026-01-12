<?php

namespace App\Http\Controllers;

use App\Models\Amenities;
use App\Models\RoomsTypes;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    
    public function Dashboard(){
        $total_rooms = \App\Models\Rooms::count();
        $occupied_rooms = \App\Models\Rooms::where('status', 'occupied')->count();
        $available_rooms = \App\Models\Rooms::where('status', 'available')->count();
        $maintenance_rooms = \App\Models\Rooms::where('status', 'maintenance')->count();
        $cleaning_rooms = \App\Models\Rooms::where('status', 'cleaning')->count();
        $total_amenities = \App\Models\Amenities::count();
        $total_guests = \App\Models\User::where('role', 'user')->count();
        $total_reviews = \App\Models\Review::count();
        $total_messages = \App\Models\Message::count();
        $all_rooms = \App\Models\Rooms::all();

        // Chart Data: Last 7 days bookings
        $bookingsData = \App\Models\Booking::selectRaw('DATE(created_at) as date, count(*) as count')
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $chartLabels = $bookingsData->pluck('date')->toArray();
        $chartValues = $bookingsData->pluck('count')->toArray();

        // Revenue Data: Monthly revenue for current year
        $revenueData = \App\Models\Booking::selectRaw('MONTHNAME(created_at) as month, SUM(total_price) as revenue')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderByRaw('MIN(created_at)')
            ->get();

        $revenueLabels = $revenueData->pluck('month')->toArray();
        $revenueValues = $revenueData->pluck('revenue')->toArray();

        // Recent Activity: Latest 5 bookings
        $recentActivities = \App\Models\Booking::latest()->limit(5)->get();

        // Guest Insights: Latest 3 Reviews and Messages
        $latestReviews = \App\Models\Review::with('user')->latest()->limit(3)->get();
        $latestMessages = \App\Models\Message::latest()->limit(3)->get();

        return view('admin.dashboard', compact(
            'total_rooms',
            'occupied_rooms',
            'available_rooms',
            'maintenance_rooms',
            'cleaning_rooms',
            'total_amenities',
            'total_guests',
            'total_reviews',
            'total_messages',
            'all_rooms',
            'chartLabels',
            'chartValues',
            'revenueLabels',
            'revenueValues',
            'recentActivities',
            'latestReviews',
            'latestMessages'
        ));
    }
    public function Rooms(){
      
        $room_types=RoomsTypes::all();
        return view('admin.rooms',compact('room_types'));
    }

    public function Testimonials(){
        $reviews = \App\Models\Review::with(['user', 'room'])->latest()->get();
        return view('admin.testimonial', compact('reviews'));
    }

    public function testimonialUpdate(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'message' => 'required|string|max:1000',
        ]);

        $review = \App\Models\Review::findOrFail($id);
        $review->update([
            'rating' => $request->rating,
            'message' => $request->message,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Testimonial updated successfully!'
        ]);
    }

    public function testimonialDestroy($id)
    {
        $review = \App\Models\Review::findOrFail($id);
        $review->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Testimonial deleted successfully!'
        ]);
    }

    public function Setting()
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        return view('admin.setting', compact('user'));
    }
}
