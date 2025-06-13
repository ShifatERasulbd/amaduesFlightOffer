<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlightController; // Add this line

Route::get('/', function () {
    return view('welcome');
});
Route::get('/flights', [FlightController::class, 'showForm'])->name('flights.form');
Route::post('/flights/search', [FlightController::class, 'search'])->name('flights.search');
Route::post('/flights/confirm', [FlightController::class, 'confirm'])->name('flights.confirm');


