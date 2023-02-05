<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/signup', [AuthController::class, "signupPage"]);
Route::get('/login', [AuthController::class, "loginPage"]);

Route::post('/signup', [AuthController::class, "signup"]);
Route::post('/logout', [AuthController::class, "logout"]);
Route::post('/login', [AuthController::class, "login"]);

Route::get('/', function () {
    return view('homepage');
});