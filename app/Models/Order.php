<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    public $updated_at = false;
    const CREATED_AT = 'order_time';

    protected $guarded = ['id','order_time'];
    protected $with = ['buyer'];
    public function buyer(): BelongsTo{
        return $this->belongsTo(Buyer::class);
    }
    public function orderDetails(): HasMany{
        return $this->hasMany(OrderDetail::class);
    }
    public function report(): HasMany{
        return $this->hasMany(Report::class);
    }
}
