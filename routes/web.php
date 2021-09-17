<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Models\Category;
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

Route::get('/',[HomeController::class,'index'])->middleware(['auth'])->name('dashboard');

Route::prefix('/quan-ly-sp')->group(function (){
    Route::get('/',[ProductController::class,'index'])->middleware(['auth'])->name('product.list');

    Route::get('{number}/paginate',[ProductController::class,'index'])->middleware(['auth'])->name('product.list.paginate');

    Route::get('/create',[ProductController::class,'create'])->middleware(['auth'])->name('product.create');

    Route::post('/create',[ProductController::class,'store'])->middleware(['auth'])->name('product.store');

    Route::get('/{id}/destroy',[ProductController::class,'destroy'])->middleware(['auth'])->name('product.destroy');

    Route::post('/destroy',[ProductController::class,'destroyAll'])->middleware(['auth'])->name('product.destroyAll');

    Route::get('/{id}/edit',[ProductController::class,'edit'])->middleware(['auth'])->name('product.edit');

    Route::post('{id}/edit',[ProductController::class,'update'])->middleware(['auth'])->name('product.update');

    Route::get('{id_category}/show',[ProductController::class,'showProductByCategoryId'])->middleware(['auth'])->name('product.showByCategoryId');

    Route::get('/search',[ProductController::class,'filter'])->middleware(['auth'])->name('product.filter');
});

Route::prefix('/danh-muc-san-pham')->middleware('auth')->group(function (){

    Route::get('/',[CategoryController::class,'index'])->name('category.index');

    Route::get('/all',[CategoryController::class,'getAll'])->name('category.all');

    Route::get('/create',[CategoryController::class,'create'])->name('category.create');

    Route::post('/store',[CategoryController::class,'store'])->name('category.store');

    Route::get('{id}/edit',[CategoryController::class,'edit'])->name('category.edit');

    Route::post('{id}/update',[CategoryController::class,'update'])->name('category.update');

    Route::post('/update-list',[CategoryController::class,'saveList'])->name('category.saveList');

    Route::get('{id}/destroy',[CategoryController::class,'destroy'])->name('category.destroy');

    Route::post('destroy',[CategoryController::class,'destroyMulti'])->name('category.destroyAll');
});

require __DIR__.'/auth.php';
