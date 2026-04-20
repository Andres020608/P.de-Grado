<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalSales = Sale::getTotalSalesValue();
        $inventoryValue = Product::getTotalInventoryValue();
        $topProducts = Sale::getTopProducts(5);
        $weeklySales = Sale::getWeeklySalesData();
        
        $lowStockProducts = Product::where('stock', '<=', 10)
            ->orderBy('stock')
            ->limit(5)
            ->get();

        $recentSales = Sale::with('user')
            ->latest('sale_date')
            ->limit(5)
            ->get();

        $topProductName = $topProducts->first()?->product->name ?? 'N/A';

        return view('dashboard', compact(
            'totalSales',
            'inventoryValue',
            'topProducts',
            'weeklySales',
            'lowStockProducts',
            'recentSales',
            'topProductName'
        ));
    }
}
