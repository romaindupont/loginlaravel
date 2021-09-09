<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthApiController;
use App\Http\Controllers\UserController;
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
Route::get('/user/list', [UserController::class, 'index'])->middleware('auth')->name('list');
Route::delete('/user/{id}', [UserController::class, 'destroy'])->middleware('auth')->name('delete');
Route::patch('/user/{id}', [UserController::class, 'update'])->middleware('auth')->name('updateUser');
