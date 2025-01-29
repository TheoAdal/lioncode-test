<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\TestCompanies;

use App\Http\Controllers\LoginUserController;
use App\Http\Controllers\TestCompaniesController; 
use App\Http\Controllers\EventController;


// Route::middleware('auth:sanctum')->post('/storecompanies', [TestCompaniesController::class, 'store'])->name('companies.store');
Route::post('/storecompanies', [TestCompaniesController::class, 'store'])->name('companies.store');

// Route::middleware('auth:sanctum')->get('/getcompanies', [TestCompaniesController::class, 'show'])->name('companies.show');
Route::middleware('auth:sanctum')->get('/getcompanies', [TestCompaniesController::class, 'show'])->name('companies.show');

//LEVEL 5 (a & b)
Route::get('/user/{user_id}/events', [EventController::class, 'getUserEvents']);
Route::get('/event/{event_id}/details', [EventController::class, 'getEventDetails']);