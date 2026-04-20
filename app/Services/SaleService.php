<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Support\Facades\DB;
use Exception;

class SaleService
{
    /**
     * @param array{
     *     customer_name: string,
     *     customer_email: string,
     *     customer_phone?: string,
     *     customer_document: string,
     *     notes?: string,
     *     user_id: int,
     *     items: array<int, array{product_id: int, quantity: int}>
     * } $data
     */
    public function createSale(array $data): Sale
    {
        return DB::transaction(function () use ($data) {
            $totalAmount = 0;
            $saleItemsData = [];

            foreach ($data['items'] as $item) {
                $product = Product::lockForUpdate()->findOrFail($item['product_id']);

                if ($product->stock < $item['quantity']) {
                    throw new Exception("Stock insuficiente para el producto: {$product->name}");
                }

                $subtotal = $product->price * $item['quantity'];
                $totalAmount += $subtotal;

                $saleItemsData[] = [
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'unit_price' => $product->price,
                    'subtotal' => $subtotal,
                ];

                // Actualizar stock
                $product->decrement('stock', $item['quantity']);
            }

            $sale = Sale::create([
                'invoice_number' => $this->generateInvoiceNumber(),
                'customer_name' => $data['customer_name'],
                'customer_email' => $data['customer_email'],
                'customer_phone' => $data['customer_phone'] ?? null,
                'customer_document' => $data['customer_document'],
                'total_amount' => $totalAmount,
                'status' => 'completada',
                'notes' => $data['notes'] ?? null,
                'user_id' => $data['user_id'],
                'sale_date' => now(),
            ]);

            foreach ($saleItemsData as $itemData) {
                $itemData['sale_id'] = $sale->id;
                SaleItem::create($itemData);
            }

            return $sale;
        });
    }

    private function generateInvoiceNumber(): string
    {
        $lastSale = Sale::orderBy('id', 'desc')->first();
        $nextNumber = $lastSale ? $lastSale->id + 1 : 1;
        return 'INV-' . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);
    }
}
