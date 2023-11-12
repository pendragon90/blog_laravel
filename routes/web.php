<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReplyChildController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TagPageController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/posts/{post}', [HomeController::class, 'show'])->name('home.post.show');
Route::post('/post/like/add', [PostController::class, 'addLike'])->name('addLike');
Route::delete('/post/like/delete', [PostController::class, 'deleteLike'])->name('deleteLike');
Route::resource('posts.comments', CommentController::class);
Route::resource('posts.comments.replies', ReplyController::class);

Route::get('/tags', [TagPageController::class, 'index'])->name('tags.page');
Route::get('/tags/{tag}', [TagPageController::class, 'show'])->name('tags.page.show');

Route::get('/dashboard', DashboardController::class)->name('dashboard')->middleware('auth');
Route::middleware(['auth'])->prefix('dashboard')->group(function () {
    Route::resource('posts', PostController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('tags', TagController::class);
});

Route::get('/about', AboutController::class)->name('about');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
