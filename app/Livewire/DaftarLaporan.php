<?php

namespace App\Livewire;

use Livewire\Component;
use App\Mail\ReportResponse;
use App\Models\ReportDetail;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Mail;

class DaftarLaporan extends Component
{
    use WithPagination;
    
    public $filter = 'all'; // Default filter
    public $popup_tanggapan = 'hidden', $user, $role = '', $isiLaporan = '', $message = '', $detailLaporan;
    public $popup_hapus = 'hidden';
    
    public function getReports()
    {
        $query = ReportDetail::with(['report.buyer', 'report.farmer'])->where('response_time', null);
        
        // Apply filters
        switch ($this->filter) {
            case 'buyer':
                $query->whereHas('report', function($q) {
                    $q->where('reporter', 'buyer');
                });
                break;
            case 'farmer':
                $query->whereHas('report', function($q) {
                    $q->where('reporter', 'farmer');
                });
                break;
            case 'system':
                $query->whereHas('report', function($q){
                    $q->whereRaw('(buyer_id IS NOT NULL XOR farmer_id IS NOT NULL)');
                });
                break;
            default:
                // 'all' - no additional filtering needed
                break;
        }
        
        return $query->latest('report_time')->paginate(10);
    }

    public function deleteReport($reportId)
    {
        ReportDetail::find($reportId)->delete();
        session()->flash('message', 'Berhasil');
    }

    public function popUpTanggapan(ReportDetail $detailLaporan){
        $this->detailLaporan = $detailLaporan;
        $this->user = $detailLaporan->report->reporter == 'farmer' ? $detailLaporan->report->farmer : $detailLaporan->report->buyer;
        $this->role = $detailLaporan->report->reporter;
        $this->isiLaporan = $detailLaporan->content_of_report;
        $this->popup_tanggapan = '';
    }

    public function kirimTanggapan(){
        $detailLaporan = $this->detailLaporan;
        $detailLaporan->admin_id = Auth::guard('admin')->user()->id;
        $detailLaporan->content_of_response = $this->message;
        $detailLaporan->response_time = now();
        $detailLaporan->save();
        $this->popup_tanggapan = 'hidden';
        $this->popup_hapus = 'hidden';
        $this->tutup();
        Mail::to($this->user->email)->send(new ReportResponse($detailLaporan->content_of_report, $detailLaporan->content_of_response));
    }

    public function tutupModal(){
        $this->popup_tanggapan = 'hidden';
        $this->popup_hapus = 'hidden';
    }

    public function tutup(){
        session()->flash('success', 'Berhasil');
        return view('livewire.daftar-laporan');
    }

    public function render()
    {
        return view('livewire.daftar-laporan', [
            'reportDetails' => $this->getReports()
        ])->layout('components.layout');
    }
}
