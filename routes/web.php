<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProducerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    $user = auth()->user();
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($user->role === 'producteur') {
        return redirect()->route('producer.dashboard');
    } else {
        return redirect()->route('client.products.index');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');

    // Routes pour les producteurs
    Route::middleware(['role:producteur'])->group(function () {
        Route::prefix('producer')->group(function () {
            Route::get('/dashboard', [ProducerController::class, 'dashboard'])->name('producer.dashboard');
            Route::get('/products', [ProductController::class, 'index'])->name('producer.products.index');
            Route::get('/products/create', [ProductController::class, 'create'])->name('producer.products.create');
            Route::post('/products', [ProductController::class, 'store'])->name('producer.products.store');
            Route::get('/products/{product}', [ProductController::class, 'show'])->name('producer.products.show');
            Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('producer.products.edit');
            Route::put('/products/{product}', [ProductController::class, 'update'])->name('producer.products.update');
            Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('producer.products.destroy');
        });
    });

    // Routes pour les clients
    Route::middleware(['role:client'])->prefix('client')->group(function () {
        Route::get('/products', [ProductController::class, 'clientIndex'])->name('client.products.index');
        Route::get('/products/{product}', [ProductController::class, 'clientShow'])->name('client.products.show');
    });

    // Routes pour l'admin
    Route::middleware(['role:admin'])->prefix('admin')->group(function () {
        Route::get('/dashboard', [ProducerController::class, 'adminDashboard'])->name('admin.dashboard');
        Route::get('/users', [ProducerController::class, 'users'])->name('admin.users');
        Route::get('/products', [ProductController::class, 'adminIndex'])->name('admin.products.index');
        Route::patch('/products/{product}/validate', [ProductController::class, 'validate'])->name('admin.products.validate');
        Route::patch('/media/{media}/validate', [ProductController::class, 'validateMedia'])->name('admin.media.validate');
    });
});

require __DIR__.'/auth.php';
