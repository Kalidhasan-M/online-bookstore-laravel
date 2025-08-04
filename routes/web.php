<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/books', [HomeController::class, 'books'])->name('books.index');
Route::get('/books/{book}', [HomeController::class, 'show'])->name('books.show');

// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Admin login
    Route::get('/login', [AdminController::class, 'login'])->name('login');
    Route::post('/login', [AdminController::class, 'authenticate'])->name('authenticate');
    
    // Protected admin routes
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
        
        // Book management
        Route::resource('books', BookController::class);
        Route::patch('/books/{book}/toggle-availability', [BookController::class, 'toggleAvailability'])
            ->name('books.toggle-availability');
        
        // Category management
        Route::resource('categories', CategoryController::class);
    });
});
