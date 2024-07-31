<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// profile controller
Route::get('/profile',[ProfileController::class,'profile'])->name('profile');

Route::post('/profile/name/update/{id}',[ProfileController::class,'name_update'])->name('name.update');
Route::post('/profile/email/update/{id}',[ProfileController::class,'email_update'])->name('email.update');
Route::post('/profile/password/update/{id}',[ProfileController::class,'password_update'])->name('password.update');
Route::post('/profile/image/update/{id}',[ProfileController::class,'image_update'])->name('image.update');


