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

Route::post('/login', [AuthController::class,'login'])->name('login');
Route::post('/register', [AuthController::class,'register'])->name('register');

Route::middleware('auth')->group(function () {

    // Auth Routes
    Route::post('/refresh', [AuthController::class,'refresh'])->name('refresh');
    Route::get('/user', [AuthController::class,'getAuthUser'])->name('auth-user');
    Route::post('/update-password', [AuthController::class,'updatePassword'])->name('update-password');
    Route::post('/logout', [AuthController::class,'logout'])->name('logout');
});
