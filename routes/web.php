<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DashboardController;
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

Route::redirect('/', 'dashboard');

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    //Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

    //Blogs
    Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/blog/{id}', [BlogController::class, 'edit'])->name('blog.edit');
    Route::post('/blog/request-topic', [BlogController::class, 'requestTopic']);
    Route::post('/blog/filter', [BlogController::class, 'filter'])->name('blog.filter');
    Route::post('/blog/store', [BlogController::class, 'store'])->name('blog.store');
    Route::put('/blog/{id}', [BlogController::class, 'update'])->name('blog.update');
    Route::delete('/blog/delete/{id}', [BlogController::class, 'delete'])->name('blog.delete');

});

require __DIR__.'/auth.php';
