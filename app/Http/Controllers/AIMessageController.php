<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminReplyMail;

class AIMessageController extends Controller
{
    /**
     * Generate a reply suggestion using Gemini AI.
     */
    public function generateReply(Request $request)
    {
        $request->validate([
            'message_id' => 'required|exists:messages,id',
            'tone' => 'nullable|string'
        ]);

        $message = Message::findOrFail($request->message_id);
        $tone = $request->tone ?: 'professional and helpful';

        $prompt = "
You are an AI assistant for 'StayEase Hotel'. 
A guest named '{$message->name}' sent the following message:
Subject: {$message->subject}
Message: {$message->message}

Write a reply to this guest. 
The tone should be {$tone}.
The reply should be concise, professional, and address their concerns or questions.
Start the email with 'Dear {$message->name},' and end with 'Best regards, StayEase Management'.
Return ONLY the email body text.
";

        try {
            $apiKey = config('gemini.api_key');
            $response = Http::withoutVerifying()
                ->post("https://generativelanguage.googleapis.com/v1/models/gemini-2.5-flash:generateContent?key={$apiKey}", [
                    'contents' => [['parts' => [['text' => $prompt]]]]
                ]);

            if (!$response->successful()) {
                Log::error('Gemini_Debugging_ID: ' . $response->status() . ' | ' . $response->body());
                return response()->json(['error' => 'AI Service unavailable: ' . $response->status()], 500);
            }

            $data = $response->json();
            $responseText = $data['candidates'][0]['content']['parts'][0]['text'] ?? '';

            return response()->json([
                'status' => 'success',
                'suggestion' => trim($responseText)
            ]);

        } catch (\Exception $e) {
            Log::error('AI Reply generation failed: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    /**
     * Send the finalized reply via email.
     */
    public function sendReply(Request $request)
    {
        $request->validate([
            'message_id' => 'required|exists:messages,id',
            'reply_content' => 'required|string'
        ]);

        $message = Message::findOrFail($request->message_id);

        try {
            Mail::to($message->email)->send(new AdminReplyMail($message, $request->reply_content));
            
            return response()->json([
                'status' => 'success',
                'message' => 'Reply sent successfully to ' . $message->email
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send admin reply email: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to send email: ' . $e->getMessage()], 500);
        }
    }
}
