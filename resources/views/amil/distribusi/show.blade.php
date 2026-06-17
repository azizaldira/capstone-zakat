@extends('layouts.app')

@section('header', 'Detail Distribusi Zakat')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Informasi Penyaluran Bantuan</h6>
                <span class="badge bg-secondary fs-6">{{ $distribusi->kode_distribusi }}</span>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <th style="width: 200px;" class="text-muted">Nama Mustahik</th>
                            <td>: <span class="fw-bold">{{ $distribusi->mustahik->nama_lengkap ?? 'Mustahik Tidak Ditemukan' }}</span></td>
                        </tr>
                        <tr>
                            <th class="text-muted">Kode Mustahik</th>
                            <td>: {{ $distribusi->mustahik->kode_mustahik ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted">Kategori Asnaf</th>
                            <td>: <span class="badge bg-info text-dark">{{ $distribusi->mustahik->kategori_asnaf ?? '-' }}</span></td>
                        </tr>
                        <tr>
                            <th class="text-muted">Kategori Bantuan</th>
                            <td>: {{ $distribusi->kategori_bantuan }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted">Nominal Distribusi</th>
                            <td>: <span class="text-success fw-bold">Rp {{ number_format($distribusi->nominal_distribusi, 0, ',', '.') }}</span></td>
                        </tr>
                        <tr>
                            <th class="text-muted">Tanggal Distribusi</th>
                            <td>: {{ $distribusi->tanggal_distribusi->format('d F Y') }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted">Keterangan</th>
                            <td>: {{ $distribusi->keterangan ?: '-' }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted">Waktu Pencatatan</th>
                            <td>: {{ $distribusi->created_at->format('d M Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted">Terakhir Diperbarui</th>
                            <td>: {{ $distribusi->updated_at->format('d M Y H:i') }}</td>
                        </tr>
                    </tbody>
                </table>

                <hr>

                <div class="d-flex gap-2 mt-4">
                    <a href="{{ route('amil.distribusi.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <a href="{{ route('amil.distribusi.edit', $distribusi->id) }}" class="btn btn-warning text-white">
                        <i class="bi bi-pencil-square"></i> Edit
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
