<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TestController;
use App\Http\Controllers\WebhooksController;

// Route::POST('test-app', [TestController::class, 'testApp']); 
Route::POST('ninepay-gateway-listener', [WebhooksController::class, 'topupWebhook']);

