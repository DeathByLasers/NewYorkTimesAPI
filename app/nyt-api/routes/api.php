<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NytController;

// Define a GET route to fetch the NYT bestsellers
Route::get('/1/nyt/best-sellers', [NytController::class, 'getBestSellers']);
