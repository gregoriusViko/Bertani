<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];
    use HasFactory;

    protected $with = ['farmer'];
    public function farmer(): BelongsTo{
        return $this->belongsTo(Farmer::class);
    }
    public function orderDetails(): HasMany{
        return $this->hasMany(OrderDetail::class, 'product_id');
    }
}
