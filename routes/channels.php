<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

// Broadcast::channel('chat.{role}.{id}', function ($user, $role, $id) {
//     return Auth::guard($role)->check() && (int) $user->id === (int) $id;
// });

Broadcast::channel('coba-ketik.{id}', function ($user, $id) {
    $user->id === $id;
});