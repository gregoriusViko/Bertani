<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use App\Models\Buyer;
use App\Models\Farmer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    function profile(){
        if (Auth::guard('admin')->check()) {
            $user = Auth::guard('admin')->user();
            $role = 'admin';
        } elseif (Auth::guard('buyer')->check()) {
            $user = Auth::guard('buyer')->user();
            $role = 'buyer';
        } else {
            $user = Auth::guard('farmer')->user();
            $role = 'farmer';
        }        
        return view('auth.ProfilePage', compact('user', 'role'));
    }

    function updates(Request $request){
        $request->validate([
            'name' => 'required|string|max:50',
            'home_address' => 'required|string|max:150',
            'phone_number' => 'required|string|regex:/^\d{10,13}$/',
            'email' => 'required|string|max:45',
        ]);

        // Dapat user
        // Dapatkan user berdasarkan jenis pengguna
                if (Auth::guard('buyer')->check()) {
                    $user = Auth::guard('buyer')->user();
                } elseif (Auth::guard('farmer')->check()) {
                    $user = Auth::guard('farmer')->user();
                } elseif (Auth::guard('admin')->check()){
                    $user = Auth::guard('admin')->user();
                } else {
                    return redirect()->route('ProfilePage');
                }

        // Update data pengguna
        $user->name = $request->input('name');
        $user->home_address = $request->input('home_address');
        $user->phone_number = $request->input('phone_number');
        $user->email = $request->input('email');


        $user->save();

        return redirect()->route('profile')->with('success','Profil telah diperbarui');
    }

}
