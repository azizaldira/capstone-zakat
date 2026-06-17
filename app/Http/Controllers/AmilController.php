<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AmilController extends Controller
{
    public function dashboard()
    {
        $data = [
            'totalMuzakki' => 0,
            'totalMustahik' => 0,
            'totalZakat' => 0,
            'totalPenyaluran' => 0,
        ];
        return view('amil.dashboard', $data);
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
