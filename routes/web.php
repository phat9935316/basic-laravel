<?php

use App\Http\Controllers\CkeditorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
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
Auth::routes();
Route::group(['middleware' => 'auth'], function(){
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/viewBlade', [HomeController::class, 'viewBlade'])->name('b1');
    Route::get('/queryBuilder', [HomeController::class, 'queryBuilder'])->name('b2');
    Route::get('/queryBuilder/datatable', [HomeController::class, 'queryBuilderDatatable'])->name('b2.datatable');
    Route::get('/eloquentORM', [HomeController::class, 'eloquentORM'])->name('b3');
    Route::get('/eloquentORM/datatable', [HomeController::class, 'eloquentORMDatatable'])->name('b3.datatable');

    Route::get('/queryBuilder/{id}', [PostController::class, 'show'])->name('post.view');
    Route::post('/comment/post/{id}', [PostController::class, 'comment'])->name('post.comment');
    Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/post/store', [PostController::class, 'store'])->name('post.store');
    Route::get('/post/edit/{id}', [PostController::class, 'edit'])->name('post.edit');
    Route::post('/post/update/{id}', [PostController::class, 'update'])->name('post.update');
    Route::post('/post/delete/{id}', [PostController::class, 'destroy'])->name('post.delete');

    Route::post('ckeditor/upload', [CkeditorController::class,'upload'])->name('ckeditor.upload');
});
