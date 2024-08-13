<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

// Redirect root URL to contacts index
Route::get('/', function () {
    return redirect()->route('contacts.index');
});

// Resource routes for ContactController
Route::resource('contacts', ContactController::class);
