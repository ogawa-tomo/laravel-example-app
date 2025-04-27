<?php

use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('messages', [MessageController::class, 'index']);
Route::post('messages', [MessageController::class, 'store']);
