<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ReportDetail;
use Livewire\WithPagination;

class DaftarLaporan extends Component
{
    use WithPagination;
    
    public $filter = 'all'; // Default filter
    public $popup_tanggapan = 'hidden', $user = '', $role = '', $isiLaporan = '';
    public $popup_hapus = 'hidden';
    
    // Listen for filter changes
    public function updatedFilter()
    {
        // Reset pagination when filter changes
        $this->resetPage();
    }
    
    public function getReports()
    {
        $query = ReportDetail::with(['report.buyer', 'report.farmer']);
        
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
        session()->flash('message', 'Laporan berhasil dihapus.');
    }

    public function popUpTanggapan(ReportDetail $detailLaporan){
        $this->user = $detailLaporan->report->reporter == 'farmer' ? $detailLaporan->report->farmer->name : $detailLaporan->report->buyer->name;
        $this->role = $detailLaporan->report->reporter;
        $this->isiLaporan = $detailLaporan->content_of_report;
        $this->popup_tanggapan = '';
    }

    public function tutup(){
        $this->popup_tanggapan = 'hidden';
        $this->popup_hapus = 'hidden';
    }

    public function render()
    {
        return view('livewire.daftar-laporan', [
            'reportDetails' => $this->getReports()
        ]);
    }
}
