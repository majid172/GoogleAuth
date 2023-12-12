<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

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

Route::get('/login/google',[LoginController::class,'googleLogin'])->name('login.google');
Route::get('/auth/google/callback', [LoginController::class,'googleLoginCallback'])->name('login.google.callback');

Route::get('/login/facebook',[LoginController::class,'facebookLogin'])->name('login.facebook');
Route::get('/login/facebook/callback', [LoginController::class,'facebookLoginCallback'])->name('login.facebook.callback');
 
