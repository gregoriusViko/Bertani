<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Buyer extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'email',
        'password',
        'home_address',
        'phone_number',
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

    public function orders(): HasMany{
        return $this->hasMany(Order::class);
    }
    public function reports(): HasMany{
        return $this->hasMany(Report::class);
    }
}
