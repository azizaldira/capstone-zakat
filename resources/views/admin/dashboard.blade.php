@extends('layouts.app')

@section('header', 'Dashboard Admin Panitia')

@section('content')
<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card bg-primary text-white shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Total Muzakki</div>
                        <div class="h5 mb-0 font-weight-bold">{{ $totalMuzakki }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-4">
        <div class="card bg-success text-white shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Total Mustahik</div>
                        <div class="h5 mb-0 font-weight-bold">{{ $totalMustahik }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card bg-info text-white shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Total Zakat Masuk</div>
                        <div class="h5 mb-0 font-weight-bold">Rp {{ number_format($totalZakat, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card bg-warning text-white shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Total Penyaluran</div>
                        <div class="h5 mb-0 font-weight-bold">Rp {{ number_format($totalPenyaluran, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Informasi Sistem</h6>
            </div>
            <div class="card-body">
                <p>Selamat datang di Dashboard Admin Panitia Sistem Informasi ZIS Masjid Al Madani.</p>
                <p>Anda login sebagai <strong>{{ Auth::user()->name }}</strong>.</p>
            </div>
        </div>
    </div>
</div>
@endsection
