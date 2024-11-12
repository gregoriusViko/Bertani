<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $guarded = ['id','created_at', 'updated_at'];

    protected $with = ['farmer', 'type'];
    public function farmer(): BelongsTo{
        return $this->belongsTo(Farmer::class);
    }
    public function type(): BelongsTo{
        return $this->belongsTo(TypeOfProduct::class, 'type_of_product_id');
    }
    public function orderDetails(): HasMany{
        return $this->hasMany(OrderDetail::class);
    }
}
