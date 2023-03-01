<?php



use App\Http\Controllers\AdminAcountController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
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


Route::get('/dashboard', function ()
{
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function ()
{
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('/management')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('main');
    Route::prefix('/categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('list_cate');
        Route::get('/listjson', [CategoryController::class, 'fetchCate'])->name('fetch_cate');
        Route::post('/store', [CategoryController::class, 'store'])->name('crete_cate');
    });
    Route::prefix('/products')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('list-product');
        Route::get('/create', [ProductController::class, 'showAdd'])->name('create-product');
        Route::get('/delete/{id}', [ProductController::class, 'destroy'])->name('delete-product');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('edit-product');
        Route::post('/update', [ProductController::class, 'update'])->name('update-product');
        Route::get('/images/{id}', [ProductController::class, 'getImages'])->name('see-image-gallery');
    });
    Route::prefix('/images')->group(function () {
        Route::get('/delete/{id}', [ProductController::class, 'deleteImageGallery'])->name('delete-image-gallery');
    });
    Route::prefix('/tags')->group(function () {
        Route::get('/delete/{id}', [ProductController::class, 'deleteTag'])->name('delete-tag');
    });
    Route::prefix('/accounts')->group(function () {
        Route::get('/create', [AdminAcountController::class, 'index'])->name('create-account');
        Route::post('/store', [AdminAcountController::class, 'store'])->name('store-account');
        Route::get('/', [AdminAcountController::class, 'getAccount'])->name('list-account');
        Route::get('/delete/{id}', [AdminAcountController::class, 'destroy'])->name('delete-account');
    });
    Route::prefix('/users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('list-user');
        Route::get('/export', [UserController::class, 'export'])->name('export-user');
        Route::post('/import', [UserController::class, 'import'])->name('import-user');
    });
});



require __DIR__ . '/auth.php';
