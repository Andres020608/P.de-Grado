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

    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])
        ->middleware(EnsureUserIsAdmin::class)
        ->name('dashboard');

    Route::middleware(EnsureUserIsAdmin::class)->group(function () {
        Route::prefix('admin')->group(function () {
            Route::resource('users', UserController::class)->except(['show'])->names([
                'index' => 'admin.users.index',
                'create' => 'admin.users.create',
                'store' => 'admin.users.store',
                'edit' => 'admin.users.edit',
                'update' => 'admin.users.update',
                'destroy' => 'admin.users.destroy',
            ]);

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

            // Ventas
            Route::get('sales', function () {
                return view('admin.sales.index');
            })->name('admin.sales.index');
            Route::get('sales/create', function () {
                return view('admin.sales.create');
            })->name('admin.sales.create');
            Route::get('sales/{sale}', function (App\Models\Sale $sale) {
                return view('admin.sales.show', compact('sale'));
            })->name('admin.sales.show');
            Route::put('sales/{sale}/status', function (Illuminate\Http\Request $request, App\Models\Sale $sale) {
                $validated = $request->validate([
                    'status' => 'required|string|in:completado,pendiente,cancelado',
                ]);
                $sale->update($validated);
                return back()->with('success', 'Estado de la venta actualizado correctamente.');
            })->name('admin.sales.update-status');
            Route::get('sales/export', [App\Http\Controllers\Admin\ReportController::class, 'exportExcel'])->name('admin.sales.export');
            Route::get('sales/{sale}/invoice', [App\Http\Controllers\Admin\ReportController::class, 'downloadInvoice'])->name('admin.sales.invoice');

            // Reportes
            Route::get('reports', [App\Http\Controllers\Admin\ReportController::class, 'index'])->name('admin.reports.index');
        });
    });
});

require __DIR__.'/auth.php';
