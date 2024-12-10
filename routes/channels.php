<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

// Broadcast::channel('chat.{role}.{id}', function ($user, $role, $id) {
//     return Auth::guard($role)->check() && (int) $user->id === (int) $id;
// });

Broadcast::channel('chat.farmer.{slug}', function ($user, $slug) {
    return $user->slug === $slug;
}, ['guards' => ['farmer']]);

Broadcast::channel('chat.buyer.{slug}', function ($user, $slug) {
    return $user->slug === $slug;
}, ['guards' => ['buyer']]);