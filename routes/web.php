<?php

use App\Http\Controllers\Admin\tvshowController as AdminTVShowController;
use App\Http\Controllers\User\tvshowController as UserTVShowController;

use App\Http\Controllers\Admin\networkController as AdminNetworkController;
use App\Http\Controllers\User\networkController as UserNetworkController;
// use App\Http\Controllers\NetworkController;
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

// Route::resource('/networks', NetworkController::class)->middleware(['auth']);

require __DIR__.'/auth.php';

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');

// Adding route to the HomeController function for Networks to check if Admin or User
Route::get('/home/networks', [App\Http\Controllers\HomeController::class, 'networksIndex'])->name('home.network.index');

// This will create all the routes for Book
// and the routes will only be available when a user is logged in

// Extra route for TV Show multiDestroy method
Route::delete('/admin/tvshows', [AdminTVShowController::class, 'multiDestroy'])->name('admin.tvshows.multiDestroy');

// Route::delete('/admin/tvshows/{network}', 'networkController@multiDestroy');

Route::resource('/admin/tvshows', AdminTVShowController::class)->middleware(['auth'])->names('admin.tvshows');

Route::resource('/user/tvshows', UserTVShowController::class)->middleware(['auth'])->names('user.tvshows')->only(['index', 'show']);



Route::resource('/admin/networks', AdminNetworkController::class)->middleware(['auth'])->names('admin.networks');

Route::resource('/user/networks', UserNetworkController::class)->middleware(['auth'])->names('user.networks')->only(['index', 'show']);


