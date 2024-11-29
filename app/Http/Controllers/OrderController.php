<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class OrderController extends Controller
{
    function daftarOrder(){
        $farmer = Auth::guard('farmer')->user();
        $orders = $farmer->products()->with('orders')->get()->pluck('orders')->flatten();
        $orders = $orders->where('order_status', '!=', 'selesai');
        return view('petani.PetDafPesananPage', compact('orders'));
    }

    public function showPaymentPage($orderId){
        
    // Ambil order berdasarkan ID yang diteruskan
    $order = Order::findOrFail($orderId);

    // Ambil data produk yang terkait dengan order
    $product = $order->product;
    
    // Ambil data harga yang terkait dengan order
    $price = $product->historyprice()->latest()->first();

    return view('pembeli.PembayaranPage', compact('order', 'product','price'));
    }

    // Simpan order setelah pembayaran dikonfirmasi
    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required',
            'payment_method' => 'required|string',
        ]);

        
        $buyer = Auth::guard('buyer')->user();
        $product = Product::findOrFail($validated['product_id']);

        $order = Order::create([
            'buyer_id' => $buyer->id,
            'product_id' => $product->id,
            'quantity_kg' => $validated['quantity'],
            'receipt_number' => strtoupper(now()->format('YmdHis') . '-' . Str::random(6)),
            'price_id' => $product->historyprice()->latest()->first()->id, 
            'payment_proof' => $validated['payment_method'],
            'order_status' => 'pending',
        ]);
        
        return redirect()->route('pembeli.PembayaranPage', ['orderId' => $order->id])->with('success', 'Order created successfully!');
    }

}