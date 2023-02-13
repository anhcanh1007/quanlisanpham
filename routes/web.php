<?php

use App\Http\Controllers\AdminAcountController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TagController;
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


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('/qladmin')->group(function () {
    Route::get('/', function () {
        return view('admin.index');
    });
    Route::prefix('/category')->group(function () {
        Route::get('/list', [CategoryController::class, 'index'])->name('list_cate');
        Route::get('/listjson', [CategoryController::class, 'fetchCate'])->name('fetch_cate');
        Route::post('/create', [CategoryController::class, 'store'])->name('crete_cate');
    });
    Route::prefix('/product')->group(function () {
        Route::get('/list', [ProductController::class, 'index'])->name('list_product');
        Route::get('/create', [ProductController::class, 'showAdd'])->name('add_product');
        Route::get('/delete/{id}', [ProductController::class, 'destroy']);
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('edit-product');
        Route::post('/update', [ProductController::class, 'update'])->name('update-product');
        Route::get('/images/{id}', [ProductController::class, 'getImages']);
    });
    Route::prefix('/images')->group(function () {
        Route::get('/delete/{id}', [ProductController::class, 'deleteImageGallery'])->name('delete-imageGallery');
    });
    Route::prefix('/tags')->group(function () {
        Route::get('/delete/{id}', [ProductController::class, 'deleteTag'])->name('delete-tag');
    });
    Route::prefix('/tag')->group(function () {
        Route::get('/list', [TagController::class, 'index']);
    });
    Route::prefix('/account')->group(function () {
        Route::get('/add', [AdminAcountController::class, 'index'])->name('add-account');
        Route::post('/add', [AdminAcountController::class, 'store'])->name('store-account');
        Route::get('/list', [AdminAcountController::class, 'getAccount'])->name('list-account');
        Route::get('/delete/{id}', [AdminAcountController::class, 'destroy']);
    });
    Route::prefix('/role')->group(function () {
        Route::get('/add/{id}', [RoleController::class, 'create']);
        Route::get('/list/{id}', [RoleController::class, 'index'])->name('role-list');
        Route::post('/add', [RoleController::class, 'store'])->name('create-role');
        Route::get('/delete/{id}', [RoleController::class, 'delete']);
        Route::get('/edit/{id}', [RoleController::class, 'edit']);
        Route::post('/update/{id}', [RoleController::class, 'update'])->name('update-role');
    });
    // Route::prefix('/user')->group(function () {
    //     Route::get('/list');
    // });
});



require __DIR__ . '/auth.php';
