<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    protected $hidden = [
        'password',
        'remember_token'
    ];
    // protected function casts(): array
    // {
    //     return [
    //         'email_verified_at' => 'datetime',
    //         'password' => 'hashed',
    //     ];
    // }
    protected $guarded = ['id', 'created_at', 'updated_at'];
    use HasFactory, Notifiable;

    public function reports(): HasMany{
        return $this->hasMany(OrderDetail::class);
    }
}
