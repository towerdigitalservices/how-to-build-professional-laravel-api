<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PhoneController;

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
    Route::post('/refresh', [AuthController::class, 'refresh'])->name('refresh');
    Route::get('/user', [AuthController::class, 'getAuthUser'])->name('auth-user');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/update-password', [AuthController::class, 'updatePassword'])->name('update-password');

    // Phone All Users Routes
    Route::get('/phones/user', [PhoneController::class, 'getUserPhones'])->name('user-phones');
    Route::post('/phones/{id}/messages', [PhoneController::class, 'sendMessage'])->name('send-message');

    // Admin/Manager Routes
    Route::group(['middleware' => 'role:admin,manager'], function() {

        // Role Routes
        Route::get('/roles', [RoleController::class, 'index'])->name('get-roles');
        Route::get('/roles/{id}', [RoleController::class, 'show'])->name('view-role');
        Route::post('/roles', [RoleController::class, 'create'])->name('create-role');
        Route::put('/roles/{id}', [RoleController::class, 'update'])->name('update-role');
        Route::delete('/roles/{id}', [RoleController::class, 'delete'])->name('delete-role');

        // Phone Routes
        Route::get('/phones',[PhoneController::class, 'index'])->name('get-phones');
        Route::post('/phones', [PhoneController::class, 'create'])->name('provision-phone');
        Route::delete('/phones/{id}', [PhoneController::class, 'delete'])->name('delete-phone');

    });
});
