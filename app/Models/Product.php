<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'supplier_id',
        'name',
        'description',
        'sku',
        'price',
        'stock',
        'metal_hallmark',
        'image',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? asset('storage/'.$this->image) : null;
    }

    public function getStockLevelAttribute(): string
    {
        if ($this->stock < 5) {
            return 'Crítico';
        }
        if ($this->stock <= 9) {
            return 'Bajo';
        }

        return 'Bien';
    }

    public function getStockColorAttribute(): string
    {
        if ($this->stock < 5) {
            return 'text-error';
        }
        if ($this->stock <= 9) {
            return 'text-secondary';
        }

        return 'text-primary';
    }

    public function getStockBarColorAttribute(): string
    {
        if ($this->stock < 5) {
            return 'bg-error';
        }
        if ($this->stock <= 9) {
            return 'bg-secondary';
        }

        return 'bg-primary';
    }

    public static function getTotalInventoryValue(): float
    {
        return self::sum(\DB::raw('price * stock'));
    }
}
