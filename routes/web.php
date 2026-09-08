<?php

use App\Http\Controllers\BirthdayMessageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/birthday-messages', [BirthdayMessageController::class, 'store'])->name('birthday-messages.store');
