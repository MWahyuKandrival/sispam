<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\QRController;
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

Route::get('/', [DashboardController::class, 'index'])->name("home");

Route::get('/login', [AuthController::class, 'index']);

Route::post('/login', [AuthController::class, 'authenticate']);

Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/admin', [DashboardController::class, 'index'])->middleware('auth');

Route::resource('/admin/petugas', PetugasController::class)->middleware('auth');

Route::resource('/petugas', PetugasController::class);

Route::get('/qrgenerate/{value}', [QRController::class, 'index']);