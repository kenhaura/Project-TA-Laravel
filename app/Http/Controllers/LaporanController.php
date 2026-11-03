<?php

namespace App\Http\Controllers;

use App\Models\MasjidBank;
use App\Models\Donation; // Sesuaikan dengan nama model donasi kamu
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function cetakLaporan()
    {
        $dataBank = MasjidBank::first();
        $donations = Donation::where('status', 'success')->get();
        
        $digital = $donations->sum('amount');
        $fisik = $dataBank->total_kas_fisik ?? 0;
        $keluar = $dataBank->total_pengeluaran ?? 0;
        $saldo = ($digital + $fisik) - $keluar;

        $data = [
            'dataBank' => $dataBank,
            'donations' => $donations,
            'saldo' => $saldo,
            'tanggal' => now()->format('d F Y'),
        ];

        $pdf = Pdf::loadView('admin.laporan_pdf', $data);
        return $pdf->stream('Laporan-Keuangan.pdf'); 
        // Gunakan stream() supaya terbuka di tab baru dulu sebelum diunduh
    }
}