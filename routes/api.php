<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;

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

    // Admin Routes
    Route::group(['middleware' => 'role:admin'], function() {

        // Role Routes
        Route::get('/roles', [RoleController::class,'index'])->name('get-roles');
        Route::get('/roles/{id}', [RoleController::class,'show'])->name('view-role');
        Route::post('/roles', [RoleController::class,'create'])->name('create-role');
        Route::put('/roles/{id}', [RoleController::class,'update'])->name('update-role');
        Route::delete('/roles/{id}', [RoleController::class,'delete'])->name('delete-role');

    });
});
