<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Buyer;
use App\Models\Farmer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\PenghapusanAkun;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    function tampilRegister()
    {
        return view('auth.register');
    }

    function submitRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|regex:/^[a-zA-Z\s]+$/|unique:farmers,name|unique:buyers,name',
            'email' => 'required|email|unique:farmers,email|unique:buyers,email|max:45',
            'telepon' => 'required|unique:farmers,phone_number|unique:buyers,phone_number|regex:/^08[0-9]{8,10}$/',
            'password' => 'required|min:6|max:45',
            'home_address' => 'required|string',
            'peran' => 'required|in:Pembeli,Petani'
        ], [
            // Pesan untuk 'name'
            'name.required' => 'Nama wajib diisi.',
            'name.alpha' => 'Nama hanya boleh mengandung huruf.',
            'name.unique' => 'Nama sudah digunakan. Silakan gunakan nama lain.',

            // Pesan untuk 'email'
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar. Silakan gunakan email lain.',
            'email.max' => 'Email tidak boleh lebih dari 45 karakter.',

            // Pesan untuk 'telepon'
            'telepon.required' => 'Nomor telepon wajib diisi.',
            'telepon.unique' => 'Nomor telepon sudah terdaftar.',
            'telepon.regex' => 'Nomor telepon harus dimulai dengan "08" dan memiliki 10-12 digit.',

            // Pesan untuk 'password'
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal harus memiliki 6 karakter.',
            'password.max' => 'Password tidak boleh lebih dari 45 karakter.',

            // Pesan untuk 'peran'
            'peran.required' => 'Peran wajib dipilih.',
            'peran.in' => 'Peran tidak valid. Pilih salah satu antara "Pembeli" atau "Petani".',
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
        $user->home_address = $request->home_address;

        if ($request->peran == 'Petani') {
            $user->bank = $request->bank;
            $user->nomor_rekening = $request->nomor_rekening;
        }
        $user->save();
        event(new Registered($user));
        // Auth::guard($guard)->login($user);
        return redirect('login');
    }

    function tampilLogin()
    {
        return view('auth.login');
    }
    function gantiEmail(Request $request){
        $request->validate([
            'email' => 'required|email|unique:farmers,email|unique:buyers,email|max:45',
        ]);
        $user = Auth::guard('farmer')->check() ? Auth::guard('farmer')->user() : Auth::guard('buyer')->user();
        $user->email = $request->email;
        $user->email_verified_at = null;
        $user->save();
        event(new Registered($user));
        return redirect()->back();
    }

    function submitLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:45',
            'password' => 'required|min:6'
        ]);
        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];
        if (Auth::guard('buyer')->attempt($data, true)) {
            // $request->session()->regenerateToken();
            return redirect()->intended('/');
        }
        if (Auth::guard('farmer')->attempt($data, true)) {
            // $request->session()->regenerateToken();
            return redirect()->intended('/');
        }
        if (Auth::guard('admin')->attempt($data, true)) {
            // $request->session()->regenerateToken();
            return redirect()->intended('/admin/laporan');
        }
        return redirect()->back()->with('gagal', "Email atau password anda salah!");
    }

    function logout(Request $request)
    {
        Auth::guard('farmer')->logout();
        Auth::guard('buyer')->logout();
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    // fungsi untuk admin
    function detailAkun(Request $request)
    {
        $user = Farmer::where('email', $request->email)->get()->first();
        $role = $user ? 'farmer' : 'buyer';
        $user = $user ? $user : Buyer::where('email', $request->email)->get()->first();
        if (!$user) {
            // abort(404);
            // 
            // return view('admin.DeleteAkun')->with('error', 'Informasi');
            return redirect('admin/delete-akun')->with('error', 'Informasi');
        }
        return view('admin.DeleteAkun', compact(['user', 'role']));
    }
    function deleteAkun($role, Request $request)
    {
        if ($role == 'farmer') {
            $farmer = Farmer::findOrFail($request->id);
            $farmer->products->each(function ($product) {
                // Menghapus setiap produk
                $product->delete();
            });
            $farmer->farmerChats->each(function ($chat) {
                $chat->delete();
            });
            $farmer->reports->each(function ($report) {
                $report->delete();
            });
            Mail::to($farmer->email)->send(new PenghapusanAkun($farmer->name, $request->reason));
            $farmer->delete();
        } else {
            $buyer = Buyer::findOrFail($request->id);
            $buyer->orders->each(function ($order) {
                // Menghapus setiap produk
                $order->delete();
            });
            $buyer->buyerChats->each(function ($chat) {
                $chat->delete();
            });
            $buyer->reports->each(function ($report) {
                $report->delete();
            });
            Mail::to($buyer->email)->send(new PenghapusanAkun($buyer->name, $request->reason));
            $buyer->delete();
        }
        return redirect('admin/delete-akun')->with('success', 'Berhasil');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $user = Farmer::where('email', $request->email)->first();
        $role = $user ? 'farmers' : 'buyers';
        $status = Password::broker($role)->sendResetLink(
            $request->only('email')
        );
        
        return $status === Password::RESET_LINK_SENT
            // ? back()->with(['status' => __($status)])
            ? back()->with('status','Terkirim ke Email Anda')
            : back()->withErrors(['email' => __($status)]);
    }

    public function showResetPasswordForm(Request $request, $token)
    {
        $email = $request->email;
        $token = $request->token;
        return view('auth.GantiPassword', compact(['email', 'token']),);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = Farmer::where('email', $request->email)->first();
        $role = $user ? 'farmers' : 'buyers';

        // dd($request->only('email', 'password', 'password_confirmation', 'token'));
        $status = Password::broker($role)->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                // Tentukan model berdasarkan tipe user
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60)
                ])->save();
            }
        );
        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]])->with('error');
    }

    public function jumlahChat(){
        $chat = Auth::guard('farmer')->check() ? Auth::guard('farmer')->user()->farmerChats : Auth::guard('buyer')->user()->buyerChats;
        $sum = $chat->sum(function($pesan){
            return $pesan->role == 'receiver' && $pesan->is_read == 0 ? 1 : 0;
        });
        return $sum;
    }
}
