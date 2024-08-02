<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;
use TCG\Voyager\Facades\Voyager;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Email verification routes
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', 'App\Http\Controllers\Auth\VerificationController@verify')
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');

Route::post('/email/verification-notification', 'App\Http\Controllers\Auth\VerificationController@send')
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');

// Dashboard route requires authentication and email verification
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/admin', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::get('/get-municipios/{departamento}', 'App\Http\Controllers\AjaxController@obtener_municipios');