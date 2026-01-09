<?php

namespace App\Http\Controllers;

use App\Models\Amenities;
use App\Models\RoomsTypes;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    
    public function Dashboard(){
        return view('admin.dashboard');
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
}
