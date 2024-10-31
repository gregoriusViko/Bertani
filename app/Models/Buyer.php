<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Buyer extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'email_address',
        'password',
    ];
    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed'
        ];
    }
    
    public function buyerChats(): HasMany{
        return $this->hasMany(BuyerChat::class);
    }

    public function farmerChats(): HasMany{
        return $this->hasMany(FarmerChat::class);
    }

    public function order(): HasMany{
        return $this->hasMany(Order::class);
    }
    public function report(): HasMany{
        return $this->hasMany(Report::class);
    }
}
