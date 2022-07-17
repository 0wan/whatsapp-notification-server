<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TokenController;
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

Route::get('/', [DashboardController::class, '__invoke']);
Route::get('/dashboard', [DashboardController::class, '__invoke'])->name('dashboard');
Route::get('/message', [MessageController::class, 'index'])->name('message.index');
Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
Route::get('/token', [TokenController::class, 'index'])->name('token.index');

require __DIR__.'/auth.php';
