<?php

namespace App\Http\Controllers;

use App\Models\Rooms;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

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
Return ONLY valid JSON with:
{
  \"room_type\": \"(must match one of: {$roomTypesString})\",
  \"reasoning\": \"(brief explanation why this matches)\",
  \"suggested_amenities\": [\"wifi\", \"near elevator\", etc]
}
";

        $client = new Client();

        try {
            $response = $client->post(
                'https://api.openai.com/v1/chat/completions',
                [
                    'verify' => false,
                    'headers' => [
                        'Authorization' => 'Bearer ' . config('services.openai.key'),
                        'Content-Type' => 'application/json',
                    ],

                    'json' => [
                        'model' => 'gpt-4o-mini',
                        'messages' => [
                            ['role' => 'user', 'content' => $prompt]
                        ],
                        'temperature' => 0.2
                    ],
                ]
            );

            $aiResult = json_decode($response->getBody(), true);
            $filters = json_decode($aiResult['choices'][0]['message']['content'], true);

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

