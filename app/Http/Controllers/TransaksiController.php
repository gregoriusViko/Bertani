<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function paymentPage(Request $request) {
        $validatedData = $request->validate([
            'stok' => 'required|integer|min:1',
            'subtotal' => 'required|numeric|min:1',
            'paymentType' => 'required'
        ]);

        $product = Product::findOrFail($request->product_id);
        $buyer = Auth::guard('buyer')->user();

        // Hitung total bayar dan biaya admin
        $adminFee = 2500;
        $totalPrice = $validatedData['subtotal'] + $adminFee;

        // Kirim data ke view pembayaran
        return view('payment', [
            'product' => $product,
            'quantity' => $validatedData['quantity'],
            'subtotal' => $validatedData['subtotal'],
            'adminFee' => $adminFee,
            'totalPrice' => $totalPrice,
            'buyer' => 'buyer',
        ]);



    }


}
