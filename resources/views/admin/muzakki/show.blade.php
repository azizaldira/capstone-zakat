@extends('layouts.app')

@section('header', 'Detail Data Muzakki')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Informasi Muzakki</h6>
                <span class="badge bg-secondary fs-6">{{ $muzakki->kode_muzakki }}</span>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <th style="width: 200px;" class="text-muted">Nama Lengkap</th>
                            <td>: <span class="fw-bold">{{ $muzakki->nama_lengkap }}</span></td>
                        </tr>
                        <tr>
                            <th class="text-muted">Jenis Kelamin</th>
                            <td>: {{ $muzakki->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted">Nomor Telepon</th>
                            <td>: {{ $muzakki->nomor_telepon }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted">Email</th>
                            <td>: {{ $muzakki->email ?: '-' }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted">Alamat Lengkap</th>
                            <td>: {{ $muzakki->alamat }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted">Tanggal Terdaftar</th>
                            <td>: {{ $muzakki->created_at->format('d M Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted">Terakhir Diperbarui</th>
                            <td>: {{ $muzakki->updated_at->format('d M Y H:i') }}</td>
                        </tr>
                    </tbody>
                </table>

                <hr>

                <div class="d-flex gap-2 mt-4">
                    <a href="{{ route('admin.muzakki.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <a href="{{ route('admin.muzakki.edit', $muzakki->id) }}" class="btn btn-warning text-white">
                        <i class="bi bi-pencil-square"></i> Edit
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
