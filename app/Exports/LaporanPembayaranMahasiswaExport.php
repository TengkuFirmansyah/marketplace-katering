<?php
namespace App\Exports;
use App\Models\MasterProdi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use DB;

class LaporanPembayaranMahasiswaExport implements FromView
{
    use Exportable;
    public function __construct($data){
        $this->data = $data;
    }
    public function view(): View
    {
        return view('excel.pembayaran-mahasiswa', [
            'data' => $this->data
        ]);
    }
}