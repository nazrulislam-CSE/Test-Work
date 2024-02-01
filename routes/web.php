<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('post', [PostController::class, 'index'])->name('post.index');
Route::post('post/store', [PostController::class, 'store'])->name('post.store');
Route::put('post/image/{post_id}', [PostController::class, 'postPhoto'])->name('post_photo');
Route::delete('post/delete/{post_id}', [PostController::class, 'postDelete'])->name('post.delete');
Route::get('post/edit/{id}', [PostController::class, 'edit'])->name('post.edit');
Route::post('post/update/{id}', [PostController::class, 'update'])->name('post.update');



require __DIR__.'/auth.php';
