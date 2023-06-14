<?php

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

Route::POST('/post-login', [App\Http\Controllers\AdminController::class, 'loginPostDashboard'])->name('login-post');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/management/user', [App\Http\Controllers\ManagementUserController::class, 'index'])->name('management/user');
Route::get('/create/user', [App\Http\Controllers\ManagementUserController::class, 'create'])->name('create/user');
Route::post('/store/user', [App\Http\Controllers\ManagementUserController::class, 'store'])->name('store/user');
Route::get('/edit/user/{id}', [App\Http\Controllers\ManagementUserController::class, 'edit'])->name('edit/user');
Route::post('/update/user/{id}', [App\Http\Controllers\ManagementUserController::class, 'update'])->name('update/user');
Route::get('/delete/user/{id}', [App\Http\Controllers\ManagementUserController::class, 'delete'])->name('delete/user');

Route::get('/management/song', [App\Http\Controllers\ManagementSongController::class, 'index'])->name('management/song');
Route::get('/create/song', [App\Http\Controllers\ManagementSongController::class, 'create'])->name('create/song');
Route::post('/store/song', [App\Http\Controllers\ManagementSongController::class, 'store'])->name('store/song');
Route::get('/edit/song/{id}', [App\Http\Controllers\ManagementSongController::class, 'edit'])->name('edit/song');
Route::post('/update/song/{id}', [App\Http\Controllers\ManagementSongController::class, 'update'])->name('update/song');
Route::get('/delete/song/{id}', [App\Http\Controllers\ManagementSongController::class, 'delete'])->name('delete/song');
