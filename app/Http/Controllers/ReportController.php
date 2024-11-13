<?php

namespace App\Http\Controllers;

use App\Models\ReportDetail;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    function index(){
        $reportDetails = ReportDetail::with(['report'])->paginate(10);
        return view('admin.LaporanPage', compact('reportDetails'));
    }
}
