<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Http;

echo "Final Test - Gemini 2.5 Flash on v1\n";
try {
    $apiKey = config('gemini.api_key');
    echo "Using key: " . substr($apiKey, 0, 5) . "...\n";
    
    $response = Http::withoutVerifying()
        ->timeout(10)
        ->post("https://generativelanguage.googleapis.com/v1/models/gemini-2.5-flash:generateContent?key={$apiKey}", [
            'contents' => [['parts' => [['text' => 'Direct test. Reply with OK.']]]]
        ]);

    echo "Status: " . $response->status() . "\n";
    echo "Body: " . $response->body() . "\n";

} catch (\Exception $e) {
    echo "EXCEPTION: " . $e->getMessage() . "\n";
}
