<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HistoryPrice extends Model
{
    /** @use HasFactory<\Database\Factories\HistoryPriceFactory> */
    use HasFactory;
    protected $guarded = ['id','created_at','updated_at'];
    protected $with = ['product'];

    public function order(): HasMany{
        return $this->hasMany(Order::class);
    }
    
    public function product(): BelongsTo{
        return $this->belongsTo(Product::class);
    }
    public function orders(): HasMany{
        return $this->hasMany(Order::class);
    }
}
