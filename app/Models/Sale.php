<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'invoice_number',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_document',
        'total_amount',
        'status',
        'notes',
        'user_id',
        'sale_date',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'sale_date' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(SaleItem::class);
    }

    public static function getTotalSalesValue(): float
    {
        return self::sum('total_amount');
    }

    public static function getTopProducts(int $limit = 5)
    {
        return SaleItem::query()
            ->select('product_id', \DB::raw('SUM(quantity) as total_sold'))
            ->with('product:id,name')
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->limit($limit)
            ->get();
    }

    public static function getWeeklySalesData()
    {
        return self::query()
            ->select(\DB::raw('DATE(sale_date) as date'), \DB::raw('COUNT(*) as count'))
            ->where('sale_date', '>=', now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get();
    }
}
