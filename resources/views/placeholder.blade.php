@extends('layouts.app')

@section('header', $title)

@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="card shadow-sm border-0 rounded-lg">
            <div class="card-body p-5 text-center">
                <div class="display-1 text-muted mb-4">
                    <i class="bi bi-tools"></i>
                </div>
                <h2 class="mb-3">Halaman {{ $title }}</h2>
                <p class="lead text-muted">Fitur ini akan dikembangkan pada tahap berikutnya.</p>
                <div class="mt-4">
                    <a href="{{ Auth::user()->isAdminPanitia() ? route('admin.dashboard') : route('amil.dashboard') }}" class="btn btn-primary">
                        Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
