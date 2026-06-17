<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class KalkulatorController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        $nisabMal = $settings['nisab_zakat_mal'] ?? 85000000;
        $nisabPenghasilan = $settings['nisab_zakat_penghasilan'] ?? 7000000;

        return view('kalkulator.index', compact('nisabMal', 'nisabPenghasilan'));
    }
}
