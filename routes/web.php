<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('api/v1')->group(function () {

    // Get all users
    //Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users');
    Route::get('/list_all_users', [App\Http\Controllers\UserController::class, 'index'])->name('users');

    // Get a single user
    //Route::get('/users/{user_id}', [App\Http\Controllers\UserController::class, 'index'])->name('users');
    Route::get('/list_all_users/{user_id}', [App\Http\Controllers\UserController::class, 'show'])->name('users');

    // Get all messages
    //Route::get('/messages', [App\Http\Controllers\MessageController::class, 'index'])->name('messages');
    Route::get('/view_messages/{user_id1}/{user_id2}', [App\Http\Controllers\MessageController::class, 'get_user_messages'])->name('messages');

    // Get a single message
    //Route::get('/messages/{message_id}', [App\Http\Controllers\MessageController::class, 'show']);
    Route::get('/view_messages/{message_id}', [App\Http\Controllers\MessageController::class, 'show'])->name('messages');;

    // Send a single message
    //Route::post('messages/send', [App\Http\Controllers\MessageController::class, 'store'])
    Route::post('/send_messages', [App\Http\Controllers\MessageController::class, 'store'])->name('messages');;

});