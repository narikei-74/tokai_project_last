<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\Guest;
use App\Http\Controllers\User;

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

Route::get('/', function () {
    return view('guest.index');
})->middleware('guest')->name('home');

Route::get('/register', [Guest\RegisterController::class, 'create'])->middleware('guest')->name('show_register');
Route::post('/register', [Guest\RegisterController::class, 'store'])->middleware('guest')->name('register');

Route::get('/login', [Guest\LoginController::class, 'index'])->middleware('guest')->name('show_login');
Route::post('/login', [Guest\LoginController::class, 'authenticate'])->middleware('guest')->name('login');
Route::get('/logout', [Guest\LoginController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/top', [User\TopController::class, 'index'])->middleware('auth')->name('show_top');
Route::post('/top/create', [User\TopController::class, 'create_theme'])->middleware('auth')->name('create_theme');

Route::get('/theme/{theme}', [User\ThemeController::class, 'index'])->middleware('auth')->name('show_theme');
Route::post('/theme/{theme}/add', [User\ThemeController::class, 'add'])->middleware('auth')->name('add_record');
Route::get('/theme/{theme}/delete/{record_id}', [User\ThemeController::class, 'delete'])->middleware('auth')->name('delete_record');
Route::get('/theme/{theme}/update/{record_id}', [User\ThemeController::class, 'show_update'])->middleware('auth')->name('show_update');
Route::post('/theme/{theme}/update/{record_id}', [User\ThemeController::class, 'update'])->middleware('auth')->name('update_record');

Route::post('/theme/{theme}/search', [User\ThemeController::class, 'search'])->middleware('auth')->name('search_record');

Route::post('/theme/{theme}/favorite', [User\ThemeController::class, 'favorite'])->middleware('auth')->name('favorite_theme');






