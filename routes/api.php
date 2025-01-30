<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginUserController;
use App\Http\Controllers\TestCompaniesController; 
use App\Http\Controllers\EventController;


// Route::->post('/storecompanies', [TestCompaniesController::class, 'store'])->name('companies.store');
Route::post('/storecompanies', [TestCompaniesController::class, 'store'])->name('companies.store');

// Route::get('/getcompanies', [TestCompaniesController::class, 'show'])->name('companies.show');
Route::middleware('auth:sanctum')->get('/getcompanies', [TestCompaniesController::class, 'show'])->name('companies.show');

//LEVEL 5 (a & b)
Route::get('/user/{userId}/events', [EventController::class, 'getUserEvents']);
Route::get('/event/{userId}/details', [EventController::class, 'getUserEventsTopicsLessonsInstructors']);