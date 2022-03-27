<?php

use App\Http\Controllers\HomeController;
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
Route::get('/',[HomeController::class,'index'])->name('index');
Route::get('/post',[HomeController::class,'post'])->name('post');
Route::post('/post/store',[HomeController::class,'post_store'])->name('post.store');
Route::post('/image/upload',[HomeController::class,'upload'])->name('upload');


