<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Farmer extends Authenticatable implements MustVerifyEmail
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'home_address',
        'phone_number',
    ];
    /** @use HasFactory<\Database\Factories\FarmerFactory> */
    use HasFactory, Notifiable;

    protected $hidden = [
        'password' => 'hashed',
        'remember_token'
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function buyerChats(): HasMany{
        return $this->hasMany(BuyerChat::class);
    }

    public function farmerChats(): HasMany{
        return $this->hasMany(FarmerChat::class);
    }

    public function products(): HasMany{
        return $this->hasMany(Product::class);
    }
    public function report(): HasMany{
        return $this->hasMany(Report::class);
    }
}
