<?php

namespace App\Http\Controllers;

use App\Models\Muzakki;
use App\Models\TransaksiZakat;
use App\Models\Mustahik;
use App\Models\DistribusiZakat;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminPanitiaController extends Controller
{
    public function dashboard()
    {
        // Totals
        $totalMuzakki = Muzakki::count();
        $totalTransaksi = TransaksiZakat::count();
        $totalDanaMasuk = TransaksiZakat::sum('nominal');
        $totalMustahik = Mustahik::count();
        $totalDistribusi = DistribusiZakat::count();
        $totalDanaTersalurkan = DistribusiZakat::sum('nominal_distribusi');
        $sisaDana = $totalDanaMasuk - $totalDanaTersalurkan;

        // Latest records
        $transaksiTerbaru = TransaksiZakat::with('muzakki')->latest()->take(5)->get();
        $distribusiTerbaru = DistribusiZakat::with('mustahik')->latest()->take(5)->get();
        $muzakkiTerbaru = Muzakki::latest()->take(5)->get();
        $mustahikTerbaru = Mustahik::latest()->take(5)->get();

        // Charts Data (Group by Month for the current year)
        $currentYear = date('Y');
        
        $penerimaanData = TransaksiZakat::whereYear('tanggal_bayar', $currentYear)
            ->get(['tanggal_bayar', 'nominal']);
        $penerimaanPerBulan = [];
        foreach ($penerimaanData as $item) {
            $bulan = (int) $item->tanggal_bayar->format('m');
            $penerimaanPerBulan[$bulan] = ($penerimaanPerBulan[$bulan] ?? 0) + $item->nominal;
        }

        $distribusiData = DistribusiZakat::whereYear('tanggal_distribusi', $currentYear)
            ->get(['tanggal_distribusi', 'nominal_distribusi']);
        $distribusiPerBulan = [];
        foreach ($distribusiData as $item) {
            $bulan = (int) $item->tanggal_distribusi->format('m');
            $distribusiPerBulan[$bulan] = ($distribusiPerBulan[$bulan] ?? 0) + $item->nominal_distribusi;
        }

        // Fill empty months with 0
        $chartPenerimaan = [];
        $chartDistribusi = [];
        for ($i = 1; $i <= 12; $i++) {
            $chartPenerimaan[] = $penerimaanPerBulan[$i] ?? 0;
            $chartDistribusi[] = $distribusiPerBulan[$i] ?? 0;
        }

        // Widgets
        $jenisZakatTerbanyak = TransaksiZakat::select('jenis_zakat', DB::raw('count(*) as count'))
            ->groupBy('jenis_zakat')
            ->orderByDesc('count')
            ->first();

        $kategoriBantuanTerbanyak = DistribusiZakat::select('kategori_bantuan', DB::raw('count(*) as count'))
            ->groupBy('kategori_bantuan')
            ->orderByDesc('count')
            ->first();

        return view('admin.dashboard', compact(
            'totalMuzakki', 'totalTransaksi', 'totalDanaMasuk',
            'totalMustahik', 'totalDistribusi', 'totalDanaTersalurkan', 'sisaDana',
            'transaksiTerbaru', 'distribusiTerbaru', 'muzakkiTerbaru', 'mustahikTerbaru',
            'chartPenerimaan', 'chartDistribusi',
            'jenisZakatTerbanyak', 'kategoriBantuanTerbanyak'
        ));
    }

    public function muzakki()
    {
        return view('placeholder', ['title' => 'Data Muzakki']);
    }

    public function transaksi()
    {
        return view('placeholder', ['title' => 'Transaksi Zakat']);
    }

    public function laporan()
    {
        return view('placeholder', ['title' => 'Laporan']);
    }

    public function profil()
    {
        return view('placeholder', ['title' => 'Profil']);
    }
}
