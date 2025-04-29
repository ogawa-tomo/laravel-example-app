<?php

use App\Http\Controllers\API\MessageController;
use Illuminate\Support\Facades\Route;

Route::prefix('messages')
    ->controller(MessageController::class)
    ->name('api.message')
    ->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('{message}', 'show')->name('show');
        Route::post('', 'store')->name('store');
        Route::delete('{message}', 'destroy')->name('destroy');
    });