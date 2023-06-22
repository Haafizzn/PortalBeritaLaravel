<?php

use App\Http\Controllers\CommentsController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [LandingController::class, 'index']) -> name('landing');

Route::get('landing/{slug}/show',[LandingController::class,'show'])->name('landingShow');

// Post Page Index
Route::get('post', [PostController::class,'index']) -> name('index');
// Post Page Create
Route::get('post/create',[PostController::class,'create']) ->name('create');
// Post Page Show
Route::get('post/{slug}/show',[PostController::class,'show']) ->name('show');
// Post Page Store
Route::post('post',[PostController::class,'store']) ->name('store');
// Post Page Edit
Route::get('post/{slug}/edit',[PostController::class,'edit']) ->name('edit');
// Post Page Update
Route::patch('post/{slug}',[PostController::class,'update']) ->name('update');
// Post Page Delete
Route::delete('post/{slug}',[PostController::class,'destroy']) ->name('delete');
// Post Page comment
Route::post('comment', [CommentsController::class,'comments']) ->name('comment');




