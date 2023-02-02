<?php

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

Route::get('/login', function () {
    return view('auth/login');
});
Route::get('/signup', function () {
    return view('auth/signup');
});

Route::get('/', function () {
    return view('homepage');
});
Route::get('/post', function () {
    return view('posts/post');
});
Route::get('/myposts', function () {
    return view('posts/myposts');
});