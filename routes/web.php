<?php

use App\Http\Controllers\Api\BookApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\Auth\LoginRegisterController;

Route::get('/', function() {
    return view('welcome');
});
Route::get('/buku',[BukuController::class,'index'])->name('buku');
Route::get( '/buku/create' , [BukuController::class,'create'])->name('buku.create'); //get buat memanggil saja
Route::post('/buku', [BukuController::class,'store'])->name('buku.store'); //post buat ngirim data
Route::delete('/buku/{id}', [BukuController::class,'destroy'])->name('buku.destroy');
Route::get('/buku/{id}/edit',[BukuController::class,'edit'])->name('buku.edit');
Route::put('/buku/{id}',[BukuController::class,'update'])->name('buku.update');
Route::get('/buku/search',[BukuController::class, 'search'])->name('buku.search');

Route::controller(LoginRegisterController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/logout', 'logout')->name('logout');
});
Route::delete('/buku/{buku}/gallery/{gallery}', [BukuController::class, 'deleteGalleryImage'])->name('buku.deleteGalleryImage');