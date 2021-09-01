<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
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
    return view('welcome');
});

Route::get('/register', [AuthController::class, 'create'])->name('subscribe');
Route::post('/register', [AuthController::class, 'store']);
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/custom-login', [AuthController::class, 'sessionStart'])->name('login.custom');
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');
Route::get('/changer', [AuthController::class, 'edit'])->middleware('auth');
Route::post('/change', [AuthController::class, 'update'])->middleware('auth');
Route::get('/dashboard', [AuthController::class, 'dashboard'])->middleware('auth')->name('dashboard');
