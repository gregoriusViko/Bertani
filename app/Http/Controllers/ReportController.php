<?php

namespace App\Http\Controllers;

use finfo;
use App\Models\Report;
use App\Models\ReportDetail;
use App\Models\Order;
use App\Models\Buyer;
use App\Models\Farmer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class ReportController extends Controller
{
    function createForSystem(Request $request)
    {
        $request->validate([
            'content_of_report' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if (Auth::guard('buyer')->check()) {
            $data = [
                'buyer_id' => Auth::guard('buyer')->user()->id,
                'reporter' => 'buyer'
            ];
        } else {
            $data = [
                'farmer_id' => Auth::guard('farmer')->user()->id,
                'reporter' => 'farmer'
            ];
        }

        $imageData = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('reports', 'private');
            $request->merge(['img' => $path]);
        }

        $report = Report::create($data);
        $request->merge(['report_id' => $report->id]);
        ReportDetail::create($request->all());

        session()->flash('success', 'Laporan Anda Berhasil Dikirim');
        return redirect('/laporan/sistem');
    }

    function createForUser() {}

    function showImage(ReportDetail $file)
    {
        $mimeType = Storage::mimeType($file->img);
        $contents = Storage::get($file->img);

        // Kembalikan response gambar
        return response($contents)->header('Content-Type', $mimeType);
    }

    public function showLaporanForm($orderId) {
        
        $order = Order::with(['product.farmer', 'buyer'])->findOrFail($orderId);

        $userId = Auth::id();
        $isBuyer = Auth::guard('buyer')->check();
        $isFarmer = Auth::guard('farmer')->check();

        //validasi akses
        if (($isBuyer && $userId !== $order->buyer_id)|| ($isFarmer && $userId !== $order->product->farmer_id)){
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke laporan ini');
        }

        // Kirim data ke view laporan
        return view('LaporanTransaksiPage', [
            'role' => $isBuyer ? 'buyer' : 'farmer',
            'receipt_number' => $order->receipt_number,
            'buyer_name' => $order->buyer->name,
            'farmer_name' => $order->product->farmer->name,
        ]);
    }

    public function submitLaporan(Request $request) {
        
        $validatedData = $request->validate([
            'receipt_number' => 'required',
            'content_of_report' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'role' => 'required|in:buyer,farmer',
        ]);

        // Sijpan file gambar bukti laporan
        $imagePath = $request->file('image')->store('laporan-images', 'public');

        // Identifikasi pelapor berdasarkan role
        $reporterId = Auth::id();
        if ($validatedData['role'] === 'buyer') {
            $buyer = Buyer::findOrFail($reporterId);
            $farmerId = Farmer::where('name', $request->farmer_name)->first()->id ?? null;
            $orderId = Order::where('receipt_number', $validatedData['receipt_number'])->first()->id ?? null;
        } else {
            $farmer = Farmer::findOrFail($reporterId);
            $buyerId = Buyer::where('name', $request->buyer_name)->first()->id ?? null;
            $orderId = Order::where('receipt_number', $validatedData['receipt_number'])->first()->id ?? null;
        }

        $report = new Report();
        $report->buyer_id = $validatedData['role'] === 'buyer' ? $buyer->id : $buyerId;
        $report->farmer_id = $validatedData['role'] === 'farmer' ? $farmer->id : $farmerId;
        $report->order_id = $orderId;
        $report->reporter = $validatedData['role'];
        $report->save();

        return redirect()->route('')->with('success', 'Laporan berhasil dikirim.');
    }


}
