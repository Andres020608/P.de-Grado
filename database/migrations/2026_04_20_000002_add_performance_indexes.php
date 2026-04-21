<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->index('sku');
            $table->index(['is_active', 'stock']);
            $table->index('category_id');
            $table->index('supplier_id');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->index('role');
        });

        Schema::table('sales', function (Blueprint $table) {
            $table->index('invoice_number');
            $table->index('status');
            $table->index('sale_date');
            $table->index('user_id');
        });

        Schema::table('sale_items', function (Blueprint $table) {
            $table->index('sale_id');
            $table->index('product_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex(['sku']);
            $table->dropIndex(['is_active', 'stock']);
            $table->dropIndex(['category_id']);
            $table->dropIndex(['supplier_id']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['role']);
        });

        Schema::table('sales', function (Blueprint $table) {
            $table->dropIndex(['invoice_number']);
            $table->dropIndex(['status']);
            $table->dropIndex(['sale_date']);
            $table->dropIndex(['user_id']);
        });

        Schema::table('sale_items', function (Blueprint $table) {
            $table->dropIndex(['sale_id']);
            $table->dropIndex(['product_id']);
        });
    }
};
