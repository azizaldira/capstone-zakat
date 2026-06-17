@extends('layouts.app')

@section('header', 'Tambah Distribusi Zakat')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Tambah Distribusi</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('amil.distribusi.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="mustahik_id" class="form-label">Nama Mustahik <span class="text-danger">*</span></label>
                        <select class="form-select @error('mustahik_id') is-invalid @enderror" id="mustahik_id" name="mustahik_id" required>
                            <option value="">-- Pilih Mustahik --</option>
                            @foreach($mustahiks as $mustahik)
                                <option value="{{ $mustahik->id }}" {{ old('mustahik_id') == $mustahik->id ? 'selected' : '' }}>
                                    {{ $mustahik->nama_lengkap }} ({{ $mustahik->kode_mustahik }} - {{ $mustahik->kategori_asnaf }})
                                </option>
                            @endforeach
                        </select>
                        <small class="text-muted">Hanya menampilkan mustahik yang berstatus 'Aktif'.</small>
                        @error('mustahik_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="kategori_bantuan" class="form-label">Kategori Bantuan <span class="text-danger">*</span></label>
                        <select class="form-select @error('kategori_bantuan') is-invalid @enderror" id="kategori_bantuan" name="kategori_bantuan" required>
                            <option value="">-- Pilih Kategori Bantuan --</option>
                            @foreach(['Zakat Fitrah', 'Zakat Mal', 'Bantuan Pendidikan', 'Bantuan Kesehatan', 'Bantuan Sosial', 'Bantuan Darurat'] as $kategori)
                                <option value="{{ $kategori }}" {{ old('kategori_bantuan') == $kategori ? 'selected' : '' }}>{{ $kategori }}</option>
                            @endforeach
                        </select>
                        @error('kategori_bantuan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nominal_distribusi" class="form-label">Nominal Distribusi (Rp) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('nominal_distribusi') is-invalid @enderror" id="nominal_distribusi" name="nominal_distribusi" value="{{ old('nominal_distribusi') }}" placeholder="Contoh: 500000" min="1" required>
                        <small class="text-muted">Masukkan angka saja tanpa titik atau koma.</small>
                        @error('nominal_distribusi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_distribusi" class="form-label">Tanggal Distribusi <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('tanggal_distribusi') is-invalid @enderror" id="tanggal_distribusi" name="tanggal_distribusi" value="{{ old('tanggal_distribusi', date('Y-m-d')) }}" required>
                        @error('tanggal_distribusi')
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
                        <a href="{{ route('amil.distribusi.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan Distribusi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
