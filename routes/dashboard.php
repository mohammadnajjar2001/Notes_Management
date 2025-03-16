<?php

use App\Http\Controllers\Dashboard\NoteController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/my/site',function(){
        return view('MySite.dashboard');
    })->name('home');
    Route::resource('/notes',NoteController::class);
    Route::patch('/notes/{note}/favorite', [NoteController::class, 'toggleFavorite'])->name('notes.favorite');

    Route::get('/none',function(){
        return view('MySite.dashboard');
    })->name('none');

    Route::get('calculator', function () {
        return view('pages.calculator');
    })->name('calculator');

    Route::get('/portfolio', function () {
        return view('pages.portfolio');
    })->name('portfolio');

    Route::get('/contact', function () {
        return view('pages.contact');
    })->name('contact');

    Route::get('/shopping', function () {
        return view('pages.shopping');
    })->name('shopping');

    Route::get('/encrypt-decrypt', function () {
        return view('pages.encrypt-decrypt');
    })->name('encrypt-decrypt');

});
