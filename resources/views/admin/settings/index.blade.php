@extends('layouts.app')

@section('header', 'Pengaturan Aplikasi')

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Konfigurasi Zakat</h6>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('admin.settings.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="nisab_zakat_mal" class="form-label">Nisab Zakat Mal (Rp) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('nisab_zakat_mal') is-invalid @enderror" id="nisab_zakat_mal" name="nisab_zakat_mal" value="{{ old('nisab_zakat_mal', $settings['nisab_zakat_mal'] ?? 85000000) }}" required>
                        <small class="text-muted">Misal: 85000000 (Setara 85 gram emas)</small>
                        @error('nisab_zakat_mal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nisab_zakat_penghasilan" class="form-label">Nisab Zakat Penghasilan / Bulan (Rp) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('nisab_zakat_penghasilan') is-invalid @enderror" id="nisab_zakat_penghasilan" name="nisab_zakat_penghasilan" value="{{ old('nisab_zakat_penghasilan', $settings['nisab_zakat_penghasilan'] ?? 7000000) }}" required>
                        <small class="text-muted">Misal: 7000000 (Sesuai ketetapan BAZNAS/Kemenag)</small>
                        @error('nisab_zakat_penghasilan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
