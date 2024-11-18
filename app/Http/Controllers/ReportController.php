<?php

namespace App\Http\Controllers;

use finfo;
use App\Models\Report;
use App\Models\ReportDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class ReportController extends Controller
{
    function index()
    {
        $reportDetails = ReportDetail::all();
        return view('admin.LaporanPage', compact('reportDetails'));
    }
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
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageData = file_get_contents($image->getRealPath());

        }

        $report = Report::create($data);
        $request->merge(['report_id' => $report->id, 'img'=>$imageData]);
        ReportDetail::create($request->all());

        session()->flash('success', 'Laporan anda telah kami terima, terimakasih!');
        return redirect('/');
    }

    function createForUser() {}

    function showImage(ReportDetail $id){
        $imageData = $id->img;

    // Menggunakan finfo untuk mendeteksi MIME type
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mimeType = $finfo->buffer($imageData);

    return Response::make($imageData, 200, [
        'Content-Type' => $mimeType,
        'Content-Length' => strlen($imageData)
    ]);
    }
}
