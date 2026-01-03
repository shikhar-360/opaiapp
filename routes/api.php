<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WebhooksController;
use App\Http\Controllers\TestController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::POST('ninepay-gateway-listener', [WebhooksController::class, 'topupWebhook']);
Route::get('/payment-status/{transaction_id}', [WebhooksController::class, 'topupCheckStatus']);
Route::get('/pending-withdraw', [WebhooksController::class, 'getPendingWithdraw']);
Route::POST('/success-withdraw', [WebhooksController::class, 'postSuccessWithdraw']);

Route::POST('/test/promotion1000', [TestController::class, 'testPromotionThounsand']);