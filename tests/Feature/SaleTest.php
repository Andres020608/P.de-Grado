<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use App\Services\SaleService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SaleTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_register_a_sale_and_decrement_stock()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $product = Product::factory()->create([
            'price' => 1000,
            'stock' => 10
        ]);

        $service = new SaleService();
        $sale = $service->createSale([
            'customer_name' => 'Juan Perez',
            'customer_email' => 'juan@example.com',
            'customer_document' => '12345678',
            'user_id' => $admin->id,
            'items' => [
                ['product_id' => $product->id, 'quantity' => 2]
            ]
        ]);

        $this->assertDatabaseHas('sales', [
            'id' => $sale->id,
            'total_amount' => 2000,
        ]);

        $this->assertDatabaseHas('sale_items', [
            'sale_id' => $sale->id,
            'product_id' => $product->id,
            'quantity' => 2,
            'unit_price' => 1000
        ]);

        $this->assertEquals(8, $product->fresh()->stock);
    }

    public function test_cannot_register_sale_with_insufficient_stock()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $product = Product::factory()->create([
            'stock' => 1
        ]);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Stock insuficiente");

        $service = new SaleService();
        $service->createSale([
            'customer_name' => 'Juan Perez',
            'customer_email' => 'juan@example.com',
            'customer_document' => '12345678',
            'user_id' => $admin->id,
            'items' => [
                ['product_id' => $product->id, 'quantity' => 5]
            ]
        ]);
    }
}
