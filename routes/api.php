<?php

use App\Http\Controllers\OfferImportController;
use Illuminate\Support\Facades\Route;

Route::post('/import-offers', OfferImportController::class);
