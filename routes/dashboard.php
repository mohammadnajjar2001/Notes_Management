<?php

use App\Http\Controllers\Dashboard\NoteController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/my/site',function(){
        return view('MySite.dashboard');
    })->name('home');
    Route::resource('/notes',NoteController::class);
});
