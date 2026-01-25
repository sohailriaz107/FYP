<?php
use App\Http\Controllers\AIRecommendationController;
use Illuminate\Support\Facades\Route;

Route::post('/ai-recommend-room', [AIRecommendationController::class, 'recommend']);
