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
            'email' => 'required|string|max:45',
            'delete_image' => 'required'
        ];

        if (Auth::guard('farmer')->check()){
            $rules['bank'] = 'required|string|in:BRI,BNI,Mandiri,BCA';
            $rules['nomor_rekening'] = [
                'required',
                'string',
                function ($attribute, $value, $fail) use ($request) {
                    $bankMaxDigits = [
                        'BRI' => 15,
                        'BNI' => 10,
                        'Mandiri' => 13,
                        'BCA' => 10,
                    ];

                    $selectedBank = $request->input('bank');
                    if (isset($bankMaxDigits[$selectedBank]) &&
                        strlen($value) !== $bankMaxDigits[$selectedBank]) {
                            $fail("Nomor rekening untuk $selectedBank harus tepat {$bankMaxDigits[$selectedBank]} digit.");
                        }
                },
            ];
        }

        $validatedData = $request->validate($rules);

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

            // Cek apakah ada file gambar baru
    // if ($request->hasFile('profile_img')) {
    //     // Jika ada gambar lama, hapus gambar lama
    //     if ($user->profile_img_link) {
    //         File::delete(public_path($user->profile_img_link));
    //     }

    //     // Simpan file gambar baru
    //     $profileImg = $request->file('profile_img');
    //     $path = $profileImg->store('users', 'public');
    //     $user->profile_img_link = '/storage/' . $path;

    // } elseif (!$user->profile_img_link) {
    //     // Jika tidak ada gambar lama dan tidak ada gambar baru, kosongkan link gambar
    //     $user->profile_img_link = null;
    // }

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
        $user->home_address = $validatedData['home_address'];
        $user->phone_number = $validatedData['phone_number'];
        $user->email = $validatedData['email'];

        if (Auth::guard('farmer')->check()){
            $user->bank = $validatedData['bank'];
            $user->nomor_rekening = $validatedData['nomor_rekening'];
        }

        if ($user->save()) {
            return redirect()->route('profile')->with('Sukses', 'Berhasil');
        }
        return redirect()->route('profile')->with('Gagal', 'Kesalahan');

    }

    public function deleteProfileImage() {
    // Tentukan user yang sedang login
        if (Auth::guard('buyer')->check()) {
            $user = Auth::guard('buyer')->user();
        } elseif (Auth::guard('farmer')->check()) {
            $user = Auth::guard('farmer')->user();
        } elseif (Auth::guard('admin')->check()) {
            $user = Auth::guard('admin')->user();
        } else {
            return redirect()->route('profile')->with('Gagal', 'Pengguna tidak ditemukan.');
        }

        // Hapus file gambar jika ada
        if ($user->profile_img_link) {
            $filePath = public_path($user->profile_img_link);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
            $user->profile_img_link = null;
            $user->save();

            return redirect()->route('profile')->with('Sukses', 'Gambar profil berhasil dihapus.');
        }

        return redirect()->route('profile')->with('Gagal', 'Tidak ada gambar untuk dihapus.');
    }


}
