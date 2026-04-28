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
            $apiKey = config('gemini.api_key');
            
            // Using direct Http facade to avoid "UnserializableResponse" library issues
            $response = \Illuminate\Support\Facades\Http::withoutVerifying()
                ->post("https://generativelanguage.googleapis.com/v1/models/gemini-2.5-flash:generateContent?key={$apiKey}", [
                    'contents' => [['parts' => [['text' => $prompt]]]]
                ]);

            if (!$response->successful()) {
                Log::error('AI Recommendation Gemini API Error: ' . $response->status() . ' | ' . $response->body());
                throw new \Exception("AI Service is currently unavailable (Status " . $response->status() . ").");
            }

            $data = $response->json();
            $responseText = $data['candidates'][0]['content']['parts'][0]['text'] ?? '';
            
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
                $html .= view('hotal.partials.room_card', [
                    'room' => $room,
                    'roomsFourColumns' => true,
                ])->render();
            }

            return response()->json([
                'status' => 'success',
                'ai_filters' => $filters,
                'html' => $html,
                'count' => $rooms->count(),
                'message' => $rooms->count() > 0 ? "AI recommends: " . $filters['room_type'] . ". " . $filters['reasoning'] : "No exact matches found, but here are rooms within your budget."
            ]);

        } catch (\Exception $e) {
            Log::error('AI Recommendation failed: ' . get_class($e) . ': ' . $e->getMessage() . ' at ' . $e->getFile() . ':' . $e->getLine());
            return response()->json([
                'status' => 'error',
                'message' => 'AI Recommendation failed (' . class_basename($e) . '): ' . $e->getMessage()
            ], 500);
        }
    }
}

