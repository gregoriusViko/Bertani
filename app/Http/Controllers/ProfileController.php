<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    function profile(){
        $user = Auth::guard('buyer')->check() ? Auth::guard('buyer')->user() : Auth::guard('farmer')->user();
        $role = Auth::guard('buyer')->check() ? 'buyer ' : 'farmer';
        return view('ProfilePage', ['user'=>$user, 'role'=>$role]);
    }

    function updates(Request $request){
        $request->validate([
            'name' => 'required|string|max:50',
            'home_address' => 'required|string|max:150',
            'phone_number' => 'required|string|regex:/^\d{10,13}$/',
            'email' => 'required|string|max45',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Dapat user
        // Dapatkan user berdasarkan jenis pengguna
                if (Auth::guard('buyer')->check()) {
                    $user = Auth::guard('buyer')->user();
                } elseif (Auth::guard('farmer')->check()) {
                    $user = Auth::guard('farmer')->user();
                }

        // Update data pengguna
        $user->name = $request->input('name');
        $user->home_address = $request->input('home_address');
        $user->phone_number = $request->input('phone_number');
        $user->email = $request->input('email');

        if  ($request->filled('password')){
            $user->password = bcrypt($request->input('password'));
        }

        // $user->save();

        return redirect()->route('ProfilePage')->with('success','Profil telah diperbarui');
    }

}
