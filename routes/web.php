<?php

use App\Http\Controllers\SidangController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::resource('user', UserController::class);
    Route::resource('sidang', SidangController::class);
    Route::post('/user/{id}', [UserController::class, 'update']);
    Route::post('/user/{id}/delete', [UserController::class, 'destroy']);

    Route::post('/sidang/{id}', [SidangController::class, 'update']);
    Route::post('/sidang/{id}/delete', [SidangController::class, 'destroy']);
    Route::post('/sidang/{id}/validasi', [SidangController::class, 'validasi']);
    Route::get('/sidang/{id}/download', [SidangController::class, 'download'])->name('sidang.download');
});

Route::get('/datatables/user', [UserController::class, 'getData'])->name('user.getData');
