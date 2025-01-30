<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;

use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\LoginUserController;
use App\Http\Controllers\TestCompaniesController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    $test = "Testing testing";
    return "<h1>" . $test .  "</h1>";
})->name('test');



//Register Routes
Route::get('/register', [RegisterUserController::class, 'register'])->name('register');
Route::post('/register',[RegisterUserController::class, 'store'])->name('register.store');

//Company Form Route
Route::get('/companies',[TestCompaniesController::class, 'form'])->name('companies.form');

//Login Route
Route::get('/login', [LoginUserController::class, 'login'])->name('login');
Route::post('/login', [LoginUserController::class, 'store'])->name('login.store');
Route::post('/logout', [LoginUserController::class, 'logout'])->middleware('auth:')->name('logout');

//MyAccountRoute
Route::get('/myaccount', function (Request $request) {
    
    if (!Auth::check()) {
        abort(403, 'Unauthorized');
    }

    $token = session('token'); 

    \Log::info('Retrieved token from session: ' . $token);

    return view('myaccount', ['token' => $token]);

})->middleware('auth:sanctum')->name('myaccount');




