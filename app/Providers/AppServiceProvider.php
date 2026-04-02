<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Fix for cURL error 60: Override the Gemini client after it's built by the deferred provider
        $this->app->extend(\Gemini\Contracts\ClientContract::class, function ($client, $app) {
            $apiKey = config('gemini.api_key');
            $timeout = config('gemini.request_timeout', 30);
            $baseURL = config('gemini.base_url');

            // Rebuild the client with our custom Guzzle config
            $newClient = \Gemini::factory()
                ->withApiKey($apiKey)
                ->withHttpClient(new \GuzzleHttp\Client([
                    'timeout' => (int) $timeout,
                    'verify' => false, // bypass SSL locally
                ]));

            // Force v1 if no base URL is specified to avoid v1beta 404s
            $finalBaseURL = $baseURL ?: 'https://generativelanguage.googleapis.com/v1';
            $newClient->withBaseUrl($finalBaseURL);

            return $newClient->make();
        });
    }
}
