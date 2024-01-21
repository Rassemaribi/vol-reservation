<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompagnieAerienneController;
use App\Http\Controllers\VolController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;




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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('api')->group(function () {
    Route::resource('compagnies-aeriennes', CompagnieAerienneController::class);
    Route::get('/logos', 'CompagnieAerienneController@getLogos');
    
});


Route::middleware('api')->group(function () {
    Route::resource('vols', VolController::class);
   
});



Route::middleware('api')->group(function () {
    Route::resource('reservations', ReservationController::class);
});

Route::middleware('api')->group(function($router) {

    Route::post('/createpayment', [PaymentController::class,
    
    'createPaymentIntent']);
    
    });


Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register']);
Route::middleware('auth:sanctum')->post('/logout', [LoginController::class,
'logout']);
// routes/web.php ou routes/api.php






