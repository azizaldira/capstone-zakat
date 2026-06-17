<?php

namespace App\Http\Controllers;

use App\Models\DistribusiZakat;
use App\Models\TransaksiZakat;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function transaksi(Request $request)
    {
        $startDate = $request->input('start_date', date('Y-m-01'));
        $endDate = $request->input('end_date', date('Y-m-d'));

        $query = TransaksiZakat::with('muzakki');

        if ($request->has('start_date') && $request->has('end_date')) {
            $request->validate([
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
            ]);
            $query->whereBetween('tanggal_bayar', [$startDate, $endDate]);
        }

        $data = $query->latest('tanggal_bayar')->get();
        $totalNominal = $data->sum('nominal');

        return view('laporan.transaksi', compact('data', 'startDate', 'endDate', 'totalNominal'));
    }

    public function cetakTransaksi(Request $request)
    {
        $startDate = $request->input('start_date', date('Y-m-01'));
        $endDate = $request->input('end_date', date('Y-m-d'));

        $data = TransaksiZakat::with('muzakki')
            ->whereBetween('tanggal_bayar', [$startDate, $endDate])
            ->latest('tanggal_bayar')
            ->get();
        $totalNominal = $data->sum('nominal');

        $pdf = Pdf::loadView('laporan.pdf_transaksi', compact('data', 'startDate', 'endDate', 'totalNominal'));
        return $pdf->stream('Laporan_Transaksi_Zakat_' . date('Ymd_His') . '.pdf');
    }

    public function distribusi(Request $request)
    {
        $startDate = $request->input('start_date', date('Y-m-01'));
        $endDate = $request->input('end_date', date('Y-m-d'));

        $query = DistribusiZakat::with('mustahik');

        if ($request->has('start_date') && $request->has('end_date')) {
            $request->validate([
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
            ]);
            $query->whereBetween('tanggal_distribusi', [$startDate, $endDate]);
        }

        $data = $query->latest('tanggal_distribusi')->get();
        $totalNominal = $data->sum('nominal_distribusi');

        return view('laporan.distribusi', compact('data', 'startDate', 'endDate', 'totalNominal'));
    }

    public function cetakDistribusi(Request $request)
    {
        $startDate = $request->input('start_date', date('Y-m-01'));
        $endDate = $request->input('end_date', date('Y-m-d'));

        $data = DistribusiZakat::with('mustahik')
            ->whereBetween('tanggal_distribusi', [$startDate, $endDate])
            ->latest('tanggal_distribusi')
            ->get();
        $totalNominal = $data->sum('nominal_distribusi');

        $pdf = Pdf::loadView('laporan.pdf_distribusi', compact('data', 'startDate', 'endDate', 'totalNominal'));
        return $pdf->stream('Laporan_Distribusi_Zakat_' . date('Ymd_His') . '.pdf');
    }
}
