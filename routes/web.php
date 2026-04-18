<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\EnsureUserIsAdmin;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::view('/', 'inicio')->name('inicio');

Route::middleware(['auth'])->group(function () {
    Route::post('logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    })->name('logout');

    Route::view('profile', 'profile')
        ->name('profile');

    Route::get('dashboard', function () {
        return view('dashboard');
    })->middleware(EnsureUserIsAdmin::class)->name('dashboard');

    Route::middleware(EnsureUserIsAdmin::class)->group(function () {
        Route::resource('users', UserController::class)->except(['show']);

        Route::prefix('admin')->group(function () {
            Route::resource('categories', CategoryController::class)->names([
                'index' => 'admin.categories.index',
                'create' => 'admin.categories.create',
                'store' => 'admin.categories.store',
                'show' => 'admin.categories.show',
                'edit' => 'admin.categories.edit',
                'update' => 'admin.categories.update',
                'destroy' => 'admin.categories.destroy',
            ]);

            Route::resource('suppliers', SupplierController::class)->names([
                'index' => 'admin.suppliers.index',
                'create' => 'admin.suppliers.create',
                'store' => 'admin.suppliers.store',
                'show' => 'admin.suppliers.show',
                'edit' => 'admin.suppliers.edit',
                'update' => 'admin.suppliers.update',
                'destroy' => 'admin.suppliers.destroy',
            ]);

            Route::resource('products', ProductController::class)->names([
                'index' => 'admin.products.index',
                'create' => 'admin.products.create',
                'store' => 'admin.products.store',
                'show' => 'admin.products.show',
                'edit' => 'admin.products.edit',
                'update' => 'admin.products.update',
                'destroy' => 'admin.products.destroy',
            ]);
        });
    });
});

require __DIR__.'/auth.php';
