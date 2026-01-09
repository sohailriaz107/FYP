<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'room_id' => 'required|exists:rooms,id',
            'rating' => 'required|integer|min:1|max:5',
            'message' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $review = Review::create([
            'user_id' => Auth::id(),
            'room_id' => $request->room_id,
            'rating' => $request->rating,
            'message' => $request->message,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Review submitted successfully!',
            'review' => $review
        ]);
    }
}
