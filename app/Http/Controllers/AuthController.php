<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Buyer;
use App\Models\Farmer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    function tampilRegister() {
        return view('register');
    }

    function submitRegister(Request $request){
        $request->validate([
            'name' => 'required|alpha|unique:farmers,name|unique:buyers,name',
            'email' => 'required|email|unique:farmers,email_address|unique:buyers,email_address|max:45',
            'telepon' => 'required|unique:farmers,phone_number|unique:buyers,phone_number|regex:/^08[0-9]{8,10}$/',
            'password' => 'required|min:6|max:45',
            'peran' => 'required|in:Pembeli,Petani'
        ]);

        if ($request->peran == 'Petani') {
            $user = new Farmer();
        } else {
            $user = new Buyer();
        }
        // Data Berdasar Kolom
        $user->email_address = $request->email;
        $user->phone_number = $request->telepon;
        $user->password = $request->password;
        $user->slug = Str::slug($request->email);
        $user->name = $request->name;
        $user->save();
        
        return redirect('login');
    }

    function tampilLogin(){
        return view('login');
    }

    function submitLogin(Request $request){

        $validator = Validator::make($request->all(), [
            'email_address' => 'required|email|max:45',
            'password' => 'required|min:6']);

        $data = [
        'email_address' => $request->input('email_address'),
        'password' => $request->input('password')
        ];
        if  (Auth::guard('buyer')->attempt($data, true)) { 
            // $request->session()->regenerateToken();
             return redirect('/');
        }if  (Auth::guard('farmer')->attempt($data, true)) { 
            // $request->session()->regenerateToken();
             return redirect('/');
        }if  (Auth::guard('admin')->attempt($data, true)) { 
            // $request->session()->regenerateToken();
             return redirect('/admin/laporan');
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
    function detailAkun(Farmer $farmer){
        dd($farmer->name);
    }
    function deleteAkun(Farmer $farmer){
        $farmer->status = 'blocked';
        $farmer->save();
        return 'berhasil';
    }
}    
