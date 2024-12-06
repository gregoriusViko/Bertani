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
    protected $with = ['buyer', 'product', 'historyPrice'];
    public function buyer(): BelongsTo{
        return $this->belongsTo(Buyer::class);
    }
    public function product(): BelongsTo{
        return $this->belongsTo(Product::class);
    }
    public function reports(): HasMany{
        return $this->hasMany(Report::class);
    }

    public function historyPrice(): BelongsTo{
        return $this->belongsTo(HistoryPrice::class, 'price_id');
    }
}
