<?php

use App\Http\Controllers\Admin\tvshowController as AdminTVShowController;
use App\Http\Controllers\User\tvshowController as UserTVShowController;
use App\Http\Controllers\NetworkController;
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

Route::resource('/networks', NetworkController::class)->middleware(['auth']);

require __DIR__.'/auth.php';

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');

// This will create all the routes for Book
// and the routes will only be available when a user is logged in
Route::resource('/admin/tvshows', AdminTVShowController::class)->middleware(['auth'])->names('admin.tvshows');

Route::resource('/user/tvshows', UserTVShowController::class)->middleware(['auth'])->names('user.tvshows')->only(['index', 'show']);

