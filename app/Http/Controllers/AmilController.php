<?php

namespace App\Http\Controllers;

use App\Models\DistribusiZakat;
use App\Models\Mustahik;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AmilController extends Controller
{
    public function dashboard()
    {
        $totalMustahik = Mustahik::count();
        $mustahikAktif = Mustahik::where('status_aktif', 'Aktif')->count();
        $totalDistribusi = DistribusiZakat::count();
        $totalDanaTersalurkan = DistribusiZakat::sum('nominal_distribusi');

        $distribusiTerbaru = DistribusiZakat::with('mustahik')->latest()->take(5)->get();

        $currentYear = date('Y');
        $distribusiData = DistribusiZakat::whereYear('tanggal_distribusi', $currentYear)
            ->get(['tanggal_distribusi', 'nominal_distribusi']);
            
        $distribusiPerBulan = [];
        foreach ($distribusiData as $item) {
            $bulan = (int) $item->tanggal_distribusi->format('m');
            $distribusiPerBulan[$bulan] = ($distribusiPerBulan[$bulan] ?? 0) + $item->nominal_distribusi;
        }

        $chartDistribusi = [];
        for ($i = 1; $i <= 12; $i++) {
            $chartDistribusi[] = $distribusiPerBulan[$i] ?? 0;
        }

        return view('amil.dashboard', compact(
            'totalMustahik', 'mustahikAktif', 'totalDistribusi', 'totalDanaTersalurkan',
            'distribusiTerbaru', 'chartDistribusi'
        ));
    }

    public function mustahik()
    {
        return view('placeholder', ['title' => 'Data Mustahik']);
    }

    public function distribusi()
    {
        return view('placeholder', ['title' => 'Distribusi Zakat']);
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
