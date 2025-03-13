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
        return redirect('https://mohammadnajjar2001.github.io/calculator-dec-and-bin/');
    })->name('calculator');

    Route::get('/portfolio', function () {
        return redirect('https://test-ea0de.web.app/');
    })->name('portfolio');

    Route::get('/contact', function () {
        return redirect('https://mohammed-nassan-najjar.web.app/');
    })->name('contact');

    Route::get('/shopping', function () {
        return redirect('https://shoping-168b7.web.app/');
    })->name('shopping');

    Route::get('/encrypt-decrypt', function () {
        return redirect('https://mohammadnajjar2001.github.io/Encrypt-decrypt/');
    })->name('encrypt-decrypt');

});
