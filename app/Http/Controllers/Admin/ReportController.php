<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Exports\SaleExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index()
    {
        // Datos para gráficas (Últimos 7 días)
        $salesByDay = Sale::select(DB::raw('DATE(sale_date) as date'), DB::raw('sum(total_amount) as total'))
            ->where('sale_date', '>=', now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Productos más vendidos
        $topProducts = SaleItem::select('product_id', DB::raw('sum(quantity) as total_qty'))
            ->with('product')
            ->groupBy('product_id')
            ->orderBy('total_qty', 'desc')
            ->limit(5)
            ->get();

        // Resumen general
        $totalRevenue = Sale::sum('total_amount');
        $totalSales = Sale::count();
        $recentSales = Sale::with('user')->orderBy('sale_date', 'desc')->limit(10)->get();

        return view('admin.reports.index', compact(
            'salesByDay', 
            'topProducts', 
            'totalRevenue', 
            'totalSales', 
            'recentSales'
        ));
    }

    public function downloadInvoice(Sale $sale)
    {
        $sale->load(['items.product', 'user']);
        
        $pdf = Pdf::loadView('admin.sales.invoice', compact('sale'));
        
        return $pdf->download("factura-{$sale->invoice_number}.pdf");
    }

    public function exportExcel()
    {
        return Excel::download(new SaleExport, 'reporte-ventas.xlsx');
    }
}
