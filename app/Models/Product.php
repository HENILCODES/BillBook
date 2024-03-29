<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'image',
        'price',
        'cost_price',
        'sku',
        'barcode',
        'brand_id',
        'description',
    ];

    function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    function orders()
    {
        return $this->belongsToMany(Order::class);
    }
}
