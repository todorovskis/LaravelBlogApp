<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/blogs', [BlogController::class, 'index'])->middleware(['auth'])->name('dashboard');
Route::get('/blogs/create', [BlogController::class, 'create'])->middleware(['auth'])->name('blogs.create');
Route::post('/blogs', [BlogController::class, 'store'])->middleware(['auth'])->name('blogs.store');
Route::get('/blogs/{blog}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
Route::delete('/blogs/{blog}', [BlogController::class, 'destroy'])->name('blogs.destroy');
Route::patch('/blogs/{blog}', [BlogController::class, 'update'])->name('blogs.update');

Route::get('/blogs/{blog}/comments/create', [CommentController::class, 'create'])->name('comments.create');
Route::post('/blogs/{blog}/comments', [CommentController::class, 'store'])->name('comments.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
