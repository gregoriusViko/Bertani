<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderDetail extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    protected $with = ['order', 'product'];
    public function order(): BelongsTo{
        return $this->belongsTo(related: Order::class);
    }
    public function product(): BelongsTo{
        return $this->belongsTo(related: Product::class);
    }
}
