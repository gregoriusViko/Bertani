<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Buyer;
use App\Models\Farmer;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    function tampilRegister() {
        return view('auth.register');
    }

    function submitRegister(Request $request){
        $request->validate([
            'name' => 'required|alpha|unique:farmers,name|unique:buyers,name',
            'email' => 'required|email|unique:farmers,email|unique:buyers,email|max:45',
            'telepon' => 'required|unique:farmers,phone_number|unique:buyers,phone_number|regex:/^08[0-9]{8,10}$/',
            'password' => 'required|min:6|max:45',
            'peran' => 'required|in:Pembeli,Petani'
        ]);

        if ($request->peran == 'Petani') {
            $user = new Farmer();
            $guard = 'farmer';
        } else {
            $user = new Buyer();
            $guard = 'buyer';
        }
        // Data Berdasar Kolom
        $user->email = $request->email;
        $user->phone_number = $request->telepon;
        $user->password = $request->password;
        $user->slug = Str::slug($request->email);
        $user->name = $request->name;
        $user->save();
        event(new Registered($user));
        Auth::guard($guard)->login($user);
        return redirect('/');
    }

    function tampilLogin(){
        return view('auth.login');
    }

    function submitLogin(Request $request){
        $request->validate([
            'email' => 'required|email|max:45',
            'password' => 'required|min:6'
        ]);
        $data = [
        'email' => $request->input('email'),
        'password' => $request->input('password')
        ];
        if  (Auth::guard('buyer')->attempt($data, true)) { 
            // $request->session()->regenerateToken();
            return redirect()->intended('/');
        }if  (Auth::guard('farmer')->attempt($data, true)) { 
            // $request->session()->regenerateToken();
            return redirect()->intended('/');
        }if  (Auth::guard('admin')->attempt($data, true)) { 
            // $request->session()->regenerateToken();
            return redirect()->intended('/admin/laporan');
        }
        return redirect()->back()->with('gagal', "Email atau password anda salah!");
    }

    function logout(Request $request){
        Auth::guard('farmer')->logout();
        Auth::guard('buyer')->logout();
        Auth::guard('admin')->logout();
 
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
 
        return redirect('/');
    }

    // fungsi untuk admin
    function detailAkun(Request $request){
        $user = Farmer::where('email', $request->email)->get()->first();
        $role = $user ? 'farmer' : 'buyer';
        $user = $user ? $user : Buyer::where('email', $request->email)->get()->first();
        if(!$user){
            abort(404);
        }
        return view('admin.DeleteAkun', compact(['user', 'role']));
    }
    function deleteAkun($role, Request $request){
        if($role == 'farmer'){
            $farmer = Farmer::findOrFail($request->id);
            $farmer->products->each(function($product) {
                // Menghapus setiap produk
                $product->delete();
            });
            $farmer->farmerChats->each(function($chat){
                $chat->delete();
            });
            $farmer->reports->each(function($report){
                $report->delete();
            });
            $farmer->delete();
        }else{

        }
        return redirect('admin/delete-akun')->with('success', 'Berhasil');
    }
}    
