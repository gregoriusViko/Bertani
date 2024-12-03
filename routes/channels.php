<?php

use App\Models\Buyer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
Broadcast::channel('chat.{role}.{id}', function ($user, $role, $id) {
    return Auth::guard($role)->check() && (int) $user->id === (int) $id;
});

Broadcast::channel('coba-ketik.{id}', function ($id) {
    // return (int) $user->id === (int) $id;
    return true;
});