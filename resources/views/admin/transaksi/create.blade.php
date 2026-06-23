@extends('layouts.app')

@section('header', 'Tambah Transaksi Zakat')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Tambah Transaksi</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.transaksi.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="muzakki_id" class="form-label">Nama Muzakki <span class="text-danger">*</span></label>
                        <select class="form-select tom-select @error('muzakki_id') is-invalid @enderror" id="muzakki_id" name="muzakki_id" required>
                            <option value="">-- Pilih Muzakki --</option>
                            @foreach($muzakkis as $muzakki)
                                <option value="{{ $muzakki->id }}" {{ old('muzakki_id') == $muzakki->id ? 'selected' : '' }}>
                                    {{ $muzakki->nama_lengkap }} ({{ $muzakki->kode_muzakki }})
                                </option>
                            @endforeach
                        </select>
                        @error('muzakki_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="jenis_zakat" class="form-label">Jenis Zakat <span class="text-danger">*</span></label>
                        <select class="form-select @error('jenis_zakat') is-invalid @enderror" id="jenis_zakat" name="jenis_zakat" required>
                            <option value="">-- Pilih Jenis Zakat --</option>
                            @foreach(['Zakat Fitrah', 'Zakat Mal', 'Infak', 'Sedekah'] as $jenis)
                                <option value="{{ $jenis }}" {{ old('jenis_zakat') == $jenis ? 'selected' : '' }}>{{ $jenis }}</option>
                            @endforeach
                        </select>
                        @error('jenis_zakat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nominal" class="form-label">Nominal (Rp) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('nominal') is-invalid @enderror" id="nominal" name="nominal" value="{{ old('nominal') }}" placeholder="Contoh: 100000" min="1" required>
                        <small class="text-muted">Masukkan angka saja tanpa titik atau koma.</small>
                        @error('nominal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="metode_pembayaran" class="form-label">Metode Pembayaran <span class="text-danger">*</span></label>
                        <select class="form-select @error('metode_pembayaran') is-invalid @enderror" id="metode_pembayaran" name="metode_pembayaran" required>
                            <option value="">-- Pilih Metode Pembayaran --</option>
                            @foreach(['Tunai', 'Transfer Bank', 'E-Wallet'] as $metode)
                                <option value="{{ $metode }}" {{ old('metode_pembayaran') == $metode ? 'selected' : '' }}>{{ $metode }}</option>
                            @endforeach
                        </select>
                        @error('metode_pembayaran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_bayar" class="form-label">Tanggal Bayar <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('tanggal_bayar') is-invalid @enderror" id="tanggal_bayar" name="tanggal_bayar" value="{{ old('tanggal_bayar', date('Y-m-d')) }}" required>
                        @error('tanggal_bayar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan <span class="text-muted">(Opsional)</span></label>
                        <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" rows="3">{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.transaksi.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
