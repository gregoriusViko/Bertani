<?php

namespace App\Models;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Buyer extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
    use HasFactory, Notifiable, SoftDeletes;
    protected $guarded = [
        'id',
        'remember_token',
        'created_at',
        'updated_at'
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
