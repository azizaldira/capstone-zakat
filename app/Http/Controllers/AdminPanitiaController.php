<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminPanitiaController extends Controller
{
    public function dashboard()
    {
        $data = [
            'totalMuzakki' => 0,
            'totalMustahik' => 0,
            'totalZakat' => 0,
            'totalPenyaluran' => 0,
        ];
        return view('admin.dashboard', $data);
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
