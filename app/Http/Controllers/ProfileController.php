<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    function profile(){
        $user = Auth::guard('buyer')->check() ? Auth::guard('buyer')->user() : Auth::guard('farmer')->user();
        $role = Auth::guard('buyer')->check() ? 'buyer ' : 'farmer';
        return view('profile', compact('user', 'role'));
    }

}
