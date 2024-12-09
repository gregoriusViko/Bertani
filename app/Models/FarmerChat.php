<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FarmerChat extends Model
{
    use HasFactory;
    const UPDATED_AT = null;
    const CREATED_AT = 'send_time';
    protected $guarded = ['send_time'];

    protected $with = ['buyer', 'farmer'];
    
    public function buyer(): BelongsTo{
        return $this->belongsTo(Buyer::class);
    }
    public function farmer(): BelongsTo{
        return $this->belongsTo(Farmer::class);
    }
}
