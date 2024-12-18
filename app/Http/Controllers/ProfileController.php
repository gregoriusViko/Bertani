<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use App\Models\Buyer;
use App\Models\Farmer;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

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
        $rules = [
            'profile_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:50',
            'home_address' => 'required|string|max:150',
            'phone_number' => 'required|string|regex:/^\d{10,13}$/',
            'delete_image' => 'required'
        ];

        if (Auth::guard('farmer')->check()){
            $rules['bank'] = 'nullable|string|in:BRI,BNI,Mandiri,BCA';
            $rules['nomor_rekening'] = [
                // Nomor rekening diperlukan jika bank dipilih
                function ($attribute, $value, $fail) use ($request) {
                    $bank = $request->input('bank');
                    
                    // Jika bank dipilih, nomor rekening wajib diisi
                    if (!empty($bank) && empty($value)) {
                        $fail('Nomor rekening wajib diisi jika bank dipilih.');
                    }

                    // Validasi panjang nomor rekening berdasarkan bank
                    $bankMaxDigits = [
                        'BRI' => 15,
                        'BNI' => 10,
                        'Mandiri' => 13,
                        'BCA' => 10,
                    ];

                    // Validasi panjang nomor rekening jika bank dan nomor rekening keduanya diisi
                    if (!empty($bank) && !empty($value)) {
                        if (isset($bankMaxDigits[$bank]) &&
                            strlen($value) !== $bankMaxDigits[$bank]) {
                                $fail("Nomor rekening untuk $bank harus tepat {$bankMaxDigits[$bank]} digit.");
                            }
                    }
                },
            ];
        }

        $validatedData = $request->validate($rules);
        // Dapat user
        // Dapatkan user berdasarkan jenis pengguna
        if (Auth::guard('buyer')->check()) {
            $user = Auth::guard('buyer')->user();
            $user->home_address = $validatedData['home_address'];
        } elseif (Auth::guard('farmer')->check()) {
            $user = Auth::guard('farmer')->user();
            $user->home_address = $validatedData['home_address'];
        } elseif (Auth::guard('admin')->check()) {
            $user = Auth::guard('admin')->user();
        } else {
            return redirect()->route('ProfilePage');
        }

            // LOGIKA GAMBAR
            if ($request->hasFile('profile_img')) {
                if ($user->profile_img_link) {
                    File::delete(public_path($user->profile_img_link));
                }
                $profileImg = $request->file('profile_img');
                $path = $profileImg->store('users', 'public');
                $user->profile_img_link = '/storage/' . $path;
            } elseif ($request->input('delete_image') == '1') {
                if ($user->profile_img_link && File::exists(public_path($user->profile_img_link))) {
                    File::delete(public_path($user->profile_img_link));
                }
                $user->profile_img_link = null;
            }

        // Update data pengguna
        $user->name = $validatedData['name'];
        $user->phone_number = $validatedData['phone_number'];

        if (Auth::guard('farmer')->check()){
            $user->bank = $validatedData['bank'];
            // $user->nomor_rekening = $validatedData['nomor_rekening'];
            $user->nomor_rekening = $validatedData['bank'] ? $validatedData['nomor_rekening'] : null ;
        }


        if ($user->save()) {
            return redirect()->route('profile')->with('Sukses', 'Berhasil');
        }
        return redirect()->route('profile')->with('Gagal', 'Kesalahan');

    }

}
