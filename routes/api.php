<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/', function () {
    return view('start');
})->name('home');

Route::get('/register', [AuthApiController::class, 'create'])->name('subscribe');
Route::post('/register', [AuthApiController::class, 'store']);
Route::get('/login', [AuthApiController::class, 'login'])->name('login');
Route::post('/custom-login', [AuthApiController::class, 'sessionStart'])->name('login.custom');
Route::get('/logout', [AuthApiController::class, 'logout'])->middleware('auth')->name('logout');
Route::get('/user', [AuthApiController::class, 'show'])->middleware('auth')->name('show');
Route::get('/{id}/edit', [AuthApiController::class, 'edit'])->middleware('auth')->name('edit');
Route::put('/user/{id}', [AuthApiController::class, 'update'])->middleware('auth')->name('update');
Route::get('/dashboard', [AuthApiController::class, 'dashboard'])->middleware('auth')->name('dashboard');
