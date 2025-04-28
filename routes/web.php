<?php

use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('messages', [MessageController::class, 'index']);
Route::post('messages', [MessageController::class, 'store']);

Route::prefix('admin/books')
    ->name('book.')
    ->controller(BookController::class)
    ->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('{book}', 'show')->whereNumber('book')->name('show');
        Route::get('create', 'create')->name('create');
        Route::post('', 'store')->name('store');
        Route::get('{book}/edit', 'edit')->whereNumber('book')->name('edit');
        Route::put('{book}', 'update')->whereNumber('book')->name('update');
    });
