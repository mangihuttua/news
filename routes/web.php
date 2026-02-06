<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AdminController;

Route::get('/index', [NewsController::class, 'index'])
     ->name('index');
Route::get('/detail/{id}', [NewsController::class, 'detail_news'])
     ->name('detail_news');
Route::get('/admin/index', [AdminController::class, 'adminIndex'])
     ->name('admin.index')
     ->middleware('auth');
Route::get('/admin/add', [AdminController::class, 'adminAdd'])
     ->name('admin.add')
     ->middleware('auth');
Route::post('/admin/store', [AdminController::class, 'adminStore'])
     ->name('admin.store');
Route::get('/admin/edit/{id}', [AdminController::class, 'adminEdit'])
     ->name('admin.edit')
     ->middleware('auth');
Route::post('/admin/update/{id}', [AdminController::class, 'adminUpdate'])
     ->name('admin.update');
Route::get('/admin/delete/{id}', [AdminController::class, 'adminDelete'])
     ->name('admin.delete');
Route::get('/admin/notifikasi', [AdminController::class, 'adminNotifikasi'])
     ->name('admin.notifikasi')
     ->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('logout');

