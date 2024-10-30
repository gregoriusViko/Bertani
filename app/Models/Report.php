<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Report extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = false;
    protected $with = ['buyer', 'farmer', 'order'];
    public function buyer(): BelongsTo{
        return $this->belongsTo(Buyer::class);
    }
    public function farmer(): BelongsTo{
        return $this->belongsTo(Farmer::class);
    }
    public function order(): BelongsTo{
        return $this->belongsTo(Order::class);
    }
}
