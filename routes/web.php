<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TwilioController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/call', function () {
    return view('call');
})->name('gCall')->middleware('auth');

Route::get('/message', function () {
    return view('message');
})->name('gMessage')->middleware('auth');

Route::post('/sendmessage', [TwilioController::class, 'sendMessage'])
->name('pMessage')->middleware('auth');

Route::post('/startcall', [TwilioController::class, 'startCall'])
->name('pCall')->middleware('auth');

Route::post('/token', [TwilioController::class, 'createAccessToken'])
->name('pToken');

Route::post('/messagecallback', [TwilioController::class, 'handleMessageCallback'])
->name('pMessageCallback');

Route::get('/voicerequest', [TwilioController::class, 'handleVoiceRequest'])
->name('gVoiceRequest');

Route::fallback(function () {
    return redirect('/');
});
