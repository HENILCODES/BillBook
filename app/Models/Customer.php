<?php

namespace App\Models;

use App\Enums\CustomerStatus;
use App\Enums\CustomerType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'type',
        'status',
        'description',
    ];

    protected $cast = [
        'status' => CustomerStatus::class,
        'type' => CustomerType::class,
    ];

    public function address(): HasMany
    {
        return $this->hasMany(Address::class);
    }
}
