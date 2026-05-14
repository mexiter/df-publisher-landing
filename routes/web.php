<?php

use App\Http\Controllers\MarketplaceContactController;
use App\Http\Controllers\MarketplacePageController;
use App\Http\Controllers\MarketplaceWaitlistController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MarketplacePageController::class, 'home'])->name('home');
Route::get('/privacy-policy', [MarketplacePageController::class, 'privacy'])->name('privacy');
Route::get('/terms', [MarketplacePageController::class, 'terms'])->name('terms');
Route::get('/publisher-terms', [MarketplacePageController::class, 'publisherTerms'])->name('publisher-terms');
Route::get('/contact', [MarketplacePageController::class, 'contact'])->name('contact');

Route::post('/waitlist', MarketplaceWaitlistController::class)
    ->middleware('throttle:waitlist')
    ->name('waitlist.store');

Route::post('/contact', MarketplaceContactController::class)
    ->middleware('throttle:contact')
    ->name('contact.store');
