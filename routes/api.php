<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */
Route::get('/', function () {
    return view('start');
});

Route::get('/register', [AuthController::class, 'create'])->name('subscribe');
Route::post('/register', [AuthController::class, 'store']);
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/custom-login', [AuthController::class, 'sessionStart'])->name('login.custom');
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');
Route::get('/user', [AuthController::class, 'show'])->middleware('auth')->name('show');
Route::get('/{id}/edit', [AuthController::class, 'edit'])->middleware('auth')->name('edit');
Route::put('/user/{id}', [AuthController::class, 'update'])->middleware('auth')->name('update');
Route::get('/dashboard', [AuthController::class, 'dashboard'])->middleware('auth')->name('dashboard');
