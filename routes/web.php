<?php

use App\Livewire\Page\About;
use App\Livewire\Page\Contact;
use App\Livewire\Page\Feature;
use App\Livewire\Page\Home;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
Route::get('/about', About::class)->name('about');
Route::get('/contact', Contact::class)->name('contact');
Route::get('/feature', Feature::class)->name('features');

// Authentication
Route::get('/login', \App\Livewire\Auth\Login::class)->name('login')->middleware('guest');

// Admin Routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', \App\Livewire\Admin\Dashboard::class)->name('dashboard');
});

// Public Download Route
Route::get('/download/latest', [\App\Http\Controllers\GameDownloadController::class, 'downloadLatest'])->name('game.download');
