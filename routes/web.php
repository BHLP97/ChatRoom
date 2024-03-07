<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Auth;

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

// Chatroom homepage
Route::get('/chatroom', [RoomController::class, 'home'])->name('home');

// create Room
Route::post('room/create', [RoomController::class, 'store'])->name('store.room');

// join Room
Route::post('room/join', [RoomController::class, 'join'])->name('join.room');

// search Room
Route::post('room/search/', [RoomController::class, 'search'])->name('room.search');

// Show room
Route::get('/room/{room_id}', [RoomController::class, 'show'])->name('room.show');

// Fetch message
Route::get('room/{room_id}/messages', [RoomController::class, 'fetchMessages']);

// Send Message
Route::post('room/{room_id}/message', [RoomController::class, 'sendMessage']);

Auth::routes();