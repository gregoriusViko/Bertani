<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Buyer;
use App\Models\Farmer;
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
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:farmers,email_address|unique:buyers,email_address|max:45',
            'telepon' => 'required|regex:/^08[0-9]{9}$/|min:11|max:45',
            'password' => 'required|min:6|max:45',
            'peran' => 'required|in:Pembeli,Petani'
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // ceking email yang sudah digunakan
        $validator->after(function ($validator) use ($request){
            $email = $request->email;
                       
            if ($request->peran == 'Petani') {
                # cek email apakah ada di tabel buyer
                if  (Buyer::where('email_address', $email)->exists()){
                    $validator->errors()->add('email', 'Email sudah terdaftar sebagai Pembeli');
                }
            } elseif ($request->peran == 'Pembeli') {
                # cek email apakah ada di tabel farmer
                if (Farmer::where('email_address', $email)->exists()){
                    $validator->errors()->add('email', 'Email sudah terdaftar sebagai Petani');
                }
            }
        });

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->peran == 'Petani') {
            $user = new Farmer();
        } else {
            $user = new Buyer();
        }

        // Data Berdasar Kolom
        $user->email_address = $request->email;
        $user->phone_number = $request->telepon;
        $user->password = $request->password;
        $user->name = $request->name;

        $user->save();

        
        return redirect('login');
    }

    function tampilLogin(Request $request){
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
             return redirect('/laporan');
        }
        return redirect()->back()->with('gagal', "Email atau password anda salah!");
    }

    function logout(Request $request){
        Auth::logout();
 
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
 
        return redirect('/home');
    }
}    
