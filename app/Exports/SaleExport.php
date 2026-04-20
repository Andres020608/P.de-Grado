<?php

namespace App\Exports;

use App\Models\Sale;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SaleExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Sale::with(['items.product', 'user'])->get();
    }

    public function headings(): array
    {
        return [
            'Factura',
            'Cliente',
            'Documento',
            'Email',
            'Total',
            'Fecha',
            'Atendido por',
            'Artículos',
        ];
    }

    public function map($sale): array
    {
        return [
            $sale->invoice_number,
            $sale->customer_name,
            $sale->customer_document,
            $sale->customer_email,
            $sale->total_amount,
            $sale->sale_date->format('d/m/Y'),
            $sale->user->name,
            $sale->items->map(fn($item) => $item->product->name . " ({$item->quantity})")->implode(', '),
        ];
    }
}
