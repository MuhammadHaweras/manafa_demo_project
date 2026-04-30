<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\CommentsController;
use App\Http\Controllers\admin\UserController;
// use App\Http\Controllers\CommentsController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\IsAdminMiddleWare;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::prefix('admin')->name('admin.')->middleware(['auth', IsAdminMiddleWare::class])->group(function () {
    Route::get('/users' , [UserController::class,'index'])->name('user.index');
    Route::delete('/users/{user}', [UserController::class,'destroy'])->name('user.delete');
    Route::get('/comments', [CommentsController::class, 'index'])->name('comments.index');
    Route::delete('/comments/{comment}' , [CommentsController::class,'destroy'])->name('comments.delete');
    Route::resource('categories', CategoryController::class);

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('posts', \App\Http\Controllers\PostController::class);

    Route::get('/edit-reply/{reply}', [App\Http\Controllers\CommentsController::class, 'edit_reply'])->name('comments.edit_reply');
    Route::put('/update-reply/{reply}', [App\Http\Controllers\CommentsController::class,'update_reply'])->name('comments.update_reply');
    Route::resource('/comments', App\Http\Controllers\CommentsController::class);
    
    
});

require __DIR__.'/auth.php';
