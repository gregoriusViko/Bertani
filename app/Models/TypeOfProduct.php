<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TypeOfProduct extends Model
{
    /** @use HasFactory<\Database\Factories\TypeOfProductFactory> */
    use HasFactory;
    protected $guarded = ['id','order_time'];
    public function product(): HasMany{
        return $this->hasMany(Product::class);
    }
    
}
