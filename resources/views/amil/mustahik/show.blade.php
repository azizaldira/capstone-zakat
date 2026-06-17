@extends('layouts.app')

@section('header', 'Detail Data Mustahik')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Informasi Mustahik</h6>
                <span class="badge bg-secondary fs-6">{{ $mustahik->kode_mustahik }}</span>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <th style="width: 200px;" class="text-muted">Nama Lengkap</th>
                            <td>: <span class="fw-bold">{{ $mustahik->nama_lengkap }}</span></td>
                        </tr>
                        <tr>
                            <th class="text-muted">Jenis Kelamin</th>
                            <td>: {{ $mustahik->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted">Kategori Asnaf</th>
                            <td>: <span class="badge bg-info text-dark">{{ $mustahik->kategori_asnaf }}</span></td>
                        </tr>
                        <tr>
                            <th class="text-muted">Nomor Telepon</th>
                            <td>: {{ $mustahik->nomor_telepon }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted">Alamat Lengkap</th>
                            <td>: {{ $mustahik->alamat }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted">Status</th>
                            <td>: 
                                @if($mustahik->status_aktif == 'Aktif')
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-danger">Tidak Aktif</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="text-muted">Keterangan</th>
                            <td>: {{ $mustahik->keterangan ?: '-' }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted">Terdaftar Sejak</th>
                            <td>: {{ $mustahik->created_at->format('d M Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted">Terakhir Diperbarui</th>
                            <td>: {{ $mustahik->updated_at->format('d M Y H:i') }}</td>
                        </tr>
                    </tbody>
                </table>

                <hr>

                <div class="d-flex gap-2 mt-4">
                    <a href="{{ route('amil.mustahik.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <a href="{{ route('amil.mustahik.edit', $mustahik->id) }}" class="btn btn-warning text-white">
                        <i class="bi bi-pencil-square"></i> Edit
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
