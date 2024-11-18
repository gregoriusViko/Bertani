<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\ReportDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    function index()
    {
        $reportDetails = ReportDetail::with(['report'])->paginate(10);
        return view('admin.LaporanPage', compact('reportDetails'));
    }
    function createForSystem(Request $request)
    {
        $request->validate([
            'content_of_report' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        dd('dkfjf');

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

        // if($request->hasFile('img')){
        //     $image = $request->file('img');
        //     $imageData = file_get_contents($image->getRealPath());

        // }

        $report = Report::create($data);
        $request->merge(['report_id' => $report->id]);
        ReportDetail::create($request->all());

        session()->flash('success', 'Laporan anda telah kami terima, terimakasih!');
        return redirect('/');
    }

    function createForUser() {}
}
