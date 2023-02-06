<?php

use App\Http\ApiController\CategoryController;
use App\Http\ApiController\ProductController;
use App\Http\ApiController\TagController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Expr\FuncCall;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/cate')->group(function () {
    Route::get('/list', [CategoryController::class, 'fetchCate']);
    Route::post('/add', [CategoryController::class, 'create']);
    Route::get('/edit/{id}', [CategoryController::class, 'getById']);
    Route::delete('/delete/{id}', [CategoryController::class, 'deleteOneCate'])->name('cate_delete');
    Route::put('/update/{id}', [CategoryController::class, 'update']);
    Route::get('/paginate', [CategoryController::class, 'getAll']);
});

Route::prefix('/product')->group(function () {
    Route::post('/add', [ProductController::class, 'create'])->name('add-product');
});

Route::prefix('/tag')->group(function () {
    Route::post('/add', [TagController::class, 'create']);
    Route::get('/list', [TagController::class, 'index']);
    Route::get('/edit/{id}', [TagController::class, 'edit']);
    Route::put('/update/{id}', [TagController::class, 'update']);
    Route::delete('/delete/{id}', [TagController::class, 'destroy']);
});