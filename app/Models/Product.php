<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'farmer_id',
        'name',
        'description',
        'stock_kg',
        'selling_unit_kg',
        'product_type',
        'price',
        'img_link',
    ];

    protected $with = ['farmer'];
    public function farmer(): BelongsTo{
        return $this->belongsTo(Farmer::class);
    }
    public function orderDetails(): HasMany{
        return $this->hasMany(OrderDetail::class);
    }
}
