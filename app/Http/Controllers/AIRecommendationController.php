<?php

namespace App\Http\Controllers;

use App\Models\Rooms;
use App\Models\RoomsTypes;
use Illuminate\Http\Request;
use Gemini\Laravel\Facades\Gemini;
use Illuminate\Support\Facades\Log;


class AIRecommendationController extends Controller
{
    //

    public function recommend(Request $request)
    {
        $request->validate([
            'budget' => 'required|numeric',
            'room_type' => 'nullable',
            'preferences' => 'nullable|string'
        ]);

        $availableRoomTypes = \App\Models\RoomsTypes::all()->pluck('name')->toArray();
        $roomTypesString = implode(', ', $availableRoomTypes);

        $prompt = "
You are an AI hotel room recommendation system.
Available Room Types in our hotel: {$roomTypesString}

User Requirements:
Budget: {$request->budget} PKR
Preferred Room Type: " . ($request->room_type ? $request->room_type : 'Any') . "
Additional Preferences: {$request->preferences}

 Based on the budget and preferences, recommend the best room type from the available list.
Return ONLY valid JSON and nothing else. No conversational text.
{
  \"room_type\": \"(must match one of: {$roomTypesString})\",
  \"reasoning\": \"(brief explanation why this matches)\",
  \"suggested_amenities\": [\"wifi\", \"near elevator\", etc]
}
";

        try {
            // Using Gemini to generate the recommendation
            $response = Gemini::generativeModel('gemini-2.5-flash')->generateContent($prompt);
            $responseText = $response->text();
            
            // Log the raw response for debugging
            Log::info("AI Recommendation raw response: " . $responseText);

            // Use regex to extract JSON block from the response
            if (preg_match('/\{.*\}/s', $responseText, $matches)) {
                $responseText = $matches[0];
            } else {
                // If no JSON block found, the AI might be explaining why it can't recommend
                Log::warning("AI did not return JSON. Raw response: " . $responseText);
                throw new \Exception("The budget might be too low. Please try an amount above 1000 PKR.");
            }

            $filters = json_decode(trim($responseText), true);

            // Handle invalid JSON response
            if (json_last_error() !== JSON_ERROR_NONE || !is_array($filters) || !isset($filters['room_type'])) {
                Log::error("AI JSON Parse Error: " . json_last_error_msg() . " | Final extracted text: " . $responseText);
                throw new \Exception("We couldn't find a perfect match. Please try adjusting your budget or preferences.");
            }


            // Database filtering: Join rooms with room_types to check base_price
            $rooms = Rooms::whereHas('roomType', function($query) use ($filters, $request) {
                $query->where('name', 'like', '%' . $filters['room_type'] . '%')
                      ->where('base_price', '<=', $request->budget);
            })
            ->where('status', 'available')
            ->with(['roomType', 'images'])
            ->get();

            if ($rooms->isEmpty()) {
                // Fallback: If no rooms match the exact AI recommendation within budget, 
                // find any room within budget.
                $rooms = Rooms::whereHas('roomType', function($query) use ($request) {
                    $query->where('base_price', '<=', $request->budget);
                })
                ->where('status', 'available')
                ->with(['roomType', 'images'])
                ->get();
            }

            $html = '';
            foreach ($rooms as $room) {
                $html .= view('hotal.partials.room_card', compact('room'))->render();
            }

            return response()->json([
                'status' => 'success',
                'ai_filters' => $filters,
                'html' => $html,
                'count' => $rooms->count(),
                'message' => $rooms->count() > 0 ? "AI recommends: " . $filters['room_type'] . ". " . $filters['reasoning'] : "No exact matches found, but here are rooms within your budget."
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'AI Recommendation failed: ' . $e->getMessage()
            ], 500);
        }
    }
}

