<?php

namespace App\Http\Controllers;

use finfo;
use App\Models\Report;
use App\Models\ReportDetail;
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

        session()->flash('success', 'Laporan anda telah kami terima, terimakasih!');
        return redirect('/');
    }

    function createForUser() {}

    function showImage(ReportDetail $file)
    {
        $mimeType = Storage::mimeType($file->img);
        $contents = Storage::get($file->img);

        // Kembalikan response gambar
        return response($contents)->header('Content-Type', $mimeType);
    }
}
