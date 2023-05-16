<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminHargaController;
use App\Http\Controllers\AdminPetugasController;
use App\Http\Controllers\AdminPelangganController;
use App\Http\Controllers\AdminPemakaianController;
use App\Http\Controllers\AdminTransaksiController;
use App\Http\Controllers\PelangganController;
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

Route::get('/', [PelangganController::class, 'index'])->name("home");

Route::get('/login', [AuthController::class, 'index'])->middleware('guest');

Route::post('/login', [AuthController::class, 'authenticate']);

Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminDashboardController::class, 'index']);

    //CRUD Petugas
    Route::get('/admin/petugas', [AdminPetugasController::class, 'index']); //Index
    Route::get('/admin/petugas/create', [AdminPetugasController::class, 'create']); //Create
    Route::post('/admin/petugas', [AdminPetugasController::class, 'store']); //Store
    Route::get('/admin/petugas/{user:id}/edit', [AdminPetugasController::class, 'edit']); //Edit
    Route::get('/admin/petugas/{user:id}', [AdminPetugasController::class, 'show']); //Show
    Route::post('/admin/petugas/{user:id}', [AdminPetugasController::class, 'delete']); //Post
    Route::put('/admin/petugas/{user:id}', [AdminPetugasController::class, 'update']); //Update
    Route::delete('/admin/petugas/{user:id}', [AdminPetugasController::class, 'destroy']); //Delete
    Route::get('/admin/petugas/atur-pelanggan/{user:id}', [AdminPetugasController::class, 'assign']); //Show List Pelanggan

    //CRUD Pelanggan
    Route::get('/admin/pelanggan', [AdminPelangganController::class, 'index']); //Index
    Route::get('/admin/pelanggan/create', [AdminPelangganController::class, 'create']); //Create
    Route::post('/admin/pelanggan', [AdminPelangganController::class, 'store']); //Store
    Route::get('/admin/pelanggan/{pelanggan:id}/edit', [AdminPelangganController::class, 'edit']); //Edit
    Route::put('/admin/pelanggan/{pelanggan:id}', [AdminPelangganController::class, 'update']); //Update
    Route::get('/admin/pelanggan/{pelanggan:id}', [AdminPelangganController::class, 'show']); //Show
    Route::post('/admin/pelanggan/{pelanggan:id}', [AdminPelangganController::class, 'delete']); //Post
    Route::delete('/admin/pelanggan/{pelanggan:id}', [AdminPelangganController::class, 'destroy']); //Delete

    //CRUD Harga
    Route::get('/admin/harga', [AdminHargaController::class, 'index']); //Index
    Route::get('/admin/harga/{harga:id}/edit', [AdminHargaController::class, 'edit']); //Edit
    Route::put('/admin/harga/{harga:id}', [AdminHargaController::class, 'update']); //Update

    //CRUD Pemakaian
    Route::get('/admin/pemakaian', [AdminPemakaianController::class, 'index']); //Index
    Route::get('/admin/pemakaian/create', [AdminPemakaianController::class, 'create']); //Create
    Route::post('/admin/pemakaian', [AdminPemakaianController::class, 'store']); //Store
    Route::get('/admin/pemakaian/{transaksi:id}/edit', [AdminPemakaianController::class, 'edit']); //Edit
    Route::put('/admin/pemakaian/{transaksi:id}', [AdminPemakaianController::class, 'update']); //Update
    Route::get('/admin/pemakaian/{transaksi:id}', [AdminPemakaianController::class, 'show']); //Show
    Route::post('/admin/pemakaian/{transaksi:id}', [AdminPemakaianController::class, 'delete']); //Post
    Route::delete('/admin/pemakaian/{transaksi:id}', [AdminPemakaianController::class, 'destroy']); //Delete

    //CRUD Transaksi
    Route::get('/admin/transaksi', [AdminTransaksiController::class, 'index']); //Index
    Route::get('/admin/transaksi/create', [AdminTransaksiController::class, 'create']); //Create
    Route::post('/admin/transaksi', [AdminTransaksiController::class, 'store']); //Store
    Route::get('/admin/transaksi/{transaksi:id}/edit', [AdminTransaksiController::class, 'edit']); //Edit
    Route::put('/admin/transaksi/{transaksi:id}', [AdminTransaksiController::class, 'update']); //Update
    Route::get('/admin/transaksi/{transaksi:id}', [AdminTransaksiController::class, 'show']); //Show
    Route::post('/admin/transaksi/{transaksi:id}', [AdminTransaksiController::class, 'delete']); //Post
    Route::delete('/admin/transaksi/{transaksi:id}', [AdminTransaksiController::class, 'destroy']); //Delete

    //Ajax
    Route::get('/admin/get-petugas/{user:id}', [AdminPetugasController::class, 'getPetugas']); //Get Ajax Petugas
});

Route::middleware(['auth', 'petugas'])->group(function () {
    Route::get('/petugas', [PetugasController::class, 'index']); //Index

    //Pelanggan
    Route::get('/petugas/pelanggan', [PetugasController::class, 'pelanggan']);
    Route::get('/petugas/pelanggan/{pelanggan:id}', [PetugasController::class, 'show_pelanggan']);

    //Transaksi
    Route::get('/petugas/transaksi', [PetugasController::class, 'transaksi']);
    Route::get('/petugas/transaksi/create', [PetugasController::class, 'create_transaksi']);
});

// Pelanggan

Route::get('/tagihan', [PelangganController::class, 'tagihan']);

Route::get('/tagihan/{pelanggan:id}', [PelangganController::class, 'getTagihan']);

Route::get('/pengaduan', [PelangganController::class, 'pengaduan']);

//Ajax
Route::get('/get-pemakaian/{pelanggan:id}', [AdminPemakaianController::class, 'getPemakaian']);
Route::get('/get-pemakaian-update/{transaksi:id}', [AdminPemakaianController::class, 'getPemakaianUpdate']);

Route::get('/qrgenerate/{value}', [QRController::class, 'index']);

Route::get('/test', [QRController::class, 'test']);
