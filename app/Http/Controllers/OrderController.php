<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    function daftarOrder(){
        $farmer = Auth::guard('farmer')->user();
        $orders = $farmer->products()->withTrashed()->with('orders')->get()->pluck('orders')->flatten();
        return view('petani.PetDafPesananPage', compact('orders'));
    }

    function detailOrder(Order $order){
        $farmer = Auth::guard('farmer')->user();
        if($order->product->farmer->id === $farmer->id){
            return view('petani.PetDetailPesanan', compact('order'));
        }else{
            abort(404);
        }
    }

    function daftarOrderPem(){
        $buyer = Auth::guard('buyer')->user();
        $orders = $buyer->orders;
        return view ('pembeli.PemDafPesananPage', compact('orders'));
    }

    public function showPaymentPage($orderId){
        
        $order = Order::findOrFail($orderId);

        if($order->buyer->id !== Auth::guard('buyer')->user()->id){
            abort(404);
        }

        $product = $order->product;
        $price = $order->price;

        return view('pembeli.PembayaranPage', compact('order', 'product','price'));
    }

    // Simpan order setelah pembayaran dikonfirmasi
    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:1',
            'payment_method' => 'required|string',
        ]);

        
        $buyer = Auth::guard('buyer')->user();
        $product = Product::findOrFail($validated['product_id']);

        $sisaStok = $product->stock_kg - $validated['quantity'];

        if($sisaStok < 0){
            return redirect()->back();
        }

        $order = Order::create([
            'buyer_id' => $buyer->id,
            'product_id' => $product->id,
            'quantity_kg' => $validated['quantity'],
            'receipt_number' => strtoupper(now()->format('YmdHis') . '-' . Str::random(6)),
            'price_id' => $product->historyprice()->latest()->first()->id, 
            'payment_proof' => $validated['payment_method'],
            'order_status' => 'menunggu konfirmasi',
        ]);

        $product->stock_kg = $sisaStok;
        
        return redirect()->route('DetailPembelianPage', $order->receipt_number)->with('success', 'Order created successfully!');
    }

    public function showDetailPembelian(Order $order){
        if($order->buyer->id === Auth::guard('buyer')->user()->id){
            return view('pembeli.DetailPembelianPage', compact('order'));
        }
        abort(404);
    }

    public function cancelOrder(Request $request, $orderId){
        $order = Order::findOrFail($orderId);
        if($order->buyer->id !== Auth::guard('buyer')->user()->id && $order->order_status !== 'selesai'){
            abort(404);
        }

        $validated = $request->validate([
            'cancellation_reason' => 'required'
        ]);

        $order->update([
            'order_status' => 'dibatalkan',
            'cancellation_reason' => $validated['cancellation_reason']
        ]);

        $product = $order->product;

        $product->stock_kg += $order->quantity_kg;
        $product->save();

        return redirect()->route('DafPesananPembeli')->with('success','order has been cancelled');
    }

    public function reject(Request $request, $orderId){
        $order = Order::findOrFail($orderId);
        if($order->product->farmer->id !== Auth::guard('farmer')->user()->id){
            abort(404);
        }
        $validated = $request->validate([
            'rejection_reason' => 'required|string',
        ]);
        
        $order->update([
            'order_status' => 'ditolak',
            'cancellation_reason' => $validated['rejection_reason']
        ]);

        $product = $order->product;

        $product->stock_kg += $order->quantity_kg;
        $product->save();

        return redirect()->back()->with('success', 'Pesanan berhasil ditolak.');
    }

    public function acceptOrder ($orderId){
        $order = Order::findOrFail($orderId);

        // update status menjadi pesanan diterima
        $order->update([
            'order_status' => 'pesanan diterima'
        ]);

        return redirect()->back()->with('success', 'Pesanan berhasil diterima.');
    }

    public function finishOrder ($orderId, Request $request) {
        $request->validate([
            'bukti_transfer' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $order = Order::findOrFail($orderId);
        
        if($order->buyer->id !== Auth::guard('buyer')->user()->id && $order->Order_status !== 'pesanan diterima'){
            return redirect()->back();
        }

        $path = null;
        if ($request->hasFile('bukti_transfer')) {
            $image = $request->file('bukti_transfer');
            $path = $image->store('bukti_transfer', 'private');
        }else if($order->payment_proof === 'Transfer')

        $order->update([
            'order_status' => 'selesai',
            'img' => $path
        ]);

        return redirect()->route('DafPesananPembeli')->with('success','order selesai');
    }

    function showImage(Order $order)
    {
        if(Auth::guard('buyer')->check()){
            if($order->buyer->id !== Auth::guard('buyer')->user()->id){
                abort(404);
            }
        }else{
            if($order->product->farmer->id !== Auth::guard('farmer')->user()->id){
                abort(404);
            }
        }
        $mimeType = Storage::mimeType($order->img);
        $contents = Storage::get($order->img);

        // Kembalikan response gambar
        return response($contents)->header('Content-Type', $mimeType);
    }
}