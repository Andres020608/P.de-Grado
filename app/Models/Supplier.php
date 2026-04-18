<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    protected $fillable = [
        'name',
        'primary_contact',
        'contact_email',
        'material_specialty',
        'location',
        'rjc_certified',
        'carbon_neutral',
        'heritage_craft',
    ];

    protected function casts(): array
    {
        return [
            'rjc_certified' => 'boolean',
            'carbon_neutral' => 'boolean',
            'heritage_craft' => 'boolean',
        ];
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
