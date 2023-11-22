<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ModelController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShoeController;


Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index']);
Route::get('/', [ShoeController::class, 'home'])->name('home');


Route::get('/shoes', [ShoeController::class, 'index'])->name('shoes');
Route::get('/shoes/detail/{id}', [ShoeController::class, 'detail']);


Route::get('shoes/add', [ShoeController::class, 'add']);
Route::post('shoes/add', [ShoeController::class, 'create'])->name('create');

Route::get('brands/add', [BrandController::class, 'add']);
Route::post('brands/add', [BrandController::class, 'create'])->name('brand.create');

Route::get('models/add', [ModelController::class, 'add']);
Route::post('models/add', [ModelController::class, 'create'])->name('model.create');


Route::get('/shoes/edit/{edit}', [ShoeController::class, 'edit'])->name('edit');
Route::put('/shoes/update/{id}', [ShoeController::class, 'update'])->name('update');


Route::get('/shoes/delete/{id}', [ShoeController::class, 'delete']);

Auth::routes();
