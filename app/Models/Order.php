<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory,SoftDeletes;


    protected $fillable = [
        'product_id',
        'customer_id',
        'qty',
        'unit_price',
    ];

    function product(){
        return $this->belongsToMany(Product::class);
    }
}
