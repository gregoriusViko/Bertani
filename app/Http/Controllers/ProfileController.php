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
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    function profile()
    {
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

    function updates(Request $request)
    {
        $request->validate([
            'profile_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:50',
            'home_address' => 'required|string|max:150',
            'phone_number' => 'required|string|regex:/^\d{10,13}$/',
            'email' => 'required|string|max:45',
            'bank' => 'string|in:BRI,BNI,MANDIRI,BCA', // Bank harus valid
            'nomor_rekening' => 'string|max:45',
            // [
            //     'required',
            //     'string',
            //     function ($attribute, $value, $fail) use ($request) {
            //         // Validasi nomor rekening berdasarkan bank yang dipilih
            //         $bankMaxDigits = [
            //             'BRI' => 15,
            //             'BNI' => 10,
            //             'MANDIRI' => 13,
            //             'BCA' => 10,
            //         ];

            //         $selectedBank = $request->input('selected_bank');
            //         if (isset($bankMaxDigits[$selectedBank]) && strlen($value) !== $bankMaxDigits[$selectedBank]) {
            //             $fail("Nomor rekening untuk $selectedBank harus tepat {$bankMaxDigits[$selectedBank]} digit.");
            //         }
            //     },
            // ],
        ]);

        // Dapat user
        // Dapatkan user berdasarkan jenis pengguna
        if (Auth::guard('buyer')->check()) {
            $user = Auth::guard('buyer')->user();
        } elseif (Auth::guard('farmer')->check()) {
            $user = Auth::guard('farmer')->user();
        } elseif (Auth::guard('admin')->check()) {
            $user = Auth::guard('admin')->user();
        } else {
            return redirect()->route('ProfilePage');
        }

        // Jika ada file gambar baru
        if ($request->hasFile('profile_img')) {
            $file = $request->file('profile_img');

            // Simpan gambar ke dalam folder 'public/profile_images'
            $path = $file->store('profile_images', 'public');

            // Hapus gambar lama jika ada
            if ($user->profile_img_link) {
                Storage::disk('public')->delete($user->profile_img_link);
            }

            // Simpan path gambar baru ke dalam database
            $user->profile_img_link = $path;
        }

        // Update data pengguna
        $user->name = $request->input('name');
        $user->home_address = $request->input('home_address');
        $user->phone_number = $request->input('phone_number');
        $user->email = $request->input('email');
        $user->bank = $request->input('bank');
        $user->nomor_rekening = $request->input('nomor_rekening');


        if ($user->save()) {
            return redirect()->route('profile')->with('Sukses', 'Berhasil');
        }
        return redirect()->route('profile')->with('Gagal', 'Kesalahan');

    }

}
