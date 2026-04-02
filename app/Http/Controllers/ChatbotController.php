<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $userMessage = $request->input('message');
        
        $systemPrompt = "
You are a helpful and professional virtual assistant for our luxurious hotel. 
Your goal is to answer guest questions about the hotel, our rooms, amenities, and booking process.
Keep your answers relatively concise, warm, and helpful. Do not mention that you are an AI from Google.
If a user asks about room types, we typically offer Single, Double, Deluxe, and Suite rooms.
If a user asks about prices or availability, tell them to check the 'Rooms' page.
Always be polite.
";

        $fullPrompt = $systemPrompt . "\n\nUser Question: " . $userMessage . "\nAssistant Answer:";

        try {
            $apiKey = config('gemini.api_key');
            $response = \Illuminate\Support\Facades\Http::withoutVerifying()
                ->post("https://generativelanguage.googleapis.com/v1/models/gemini-2.5-flash:generateContent?key={$apiKey}", [
                    'contents' => [['parts' => [['text' => $fullPrompt]]]]
                ]);

            if ($response->successful()) {
                $data = $response->json();
                return response()->json([
                    'status' => 'success',
                    'reply' => $data['candidates'][0]['content']['parts'][0]['text'] ?? "I'm sorry, I couldn't process that."
                ]);
            }
            
            Log::error('Gemini API Details: Status: ' . $response->status() . ' | Body: ' . $response->body());
            throw new \Exception("Gemini API Error: " . $response->status());

        } catch (\Exception $e) {
            Log::error('Chatbot error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'reply' => 'I apologize, but I am currently experiencing technical difficulties.'
            ], 500);
        }
    }
}
