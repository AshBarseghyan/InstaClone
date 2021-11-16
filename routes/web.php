<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfilesController;

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


Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [PostsController::class, 'index']);
    Route::post('/p', [PostsController::class, 'store'])->name('p.store');
    Route::get('/p/create', [PostsController::class, 'create'])->name('p.create');
    Route::get('/p/{post}', [PostsController::class, 'show'])->name('p.show');
});

Route::get('/profile/{user}', [ProfilesController::class, 'index'])->name('profile.show');
Route::patch('/profile/{user}', [ProfilesController::class, 'update'])->name('profile.update');
Route::get('/profile/{user}/edit', [ProfilesController::class, 'edit'])->name('profile.edit');



Route::get('/email', function () {
    return new \App\Mail\NewUserWelcomeMail();
});

Route::post('follow/{user}', [\App\Http\Controllers\FollowsController::class, 'store']);

Route::get('like/{post}',[\App\Http\Controllers\LikesController::class,'store'])->name('like.store');
Route::get('likes',[\App\Http\Controllers\LikesController::class,'contain'])->name('likes.contain');



