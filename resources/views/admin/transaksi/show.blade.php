@extends('layouts.app')

@section('header', 'Detail Transaksi Zakat')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Informasi Transaksi</h6>
                <span class="badge bg-secondary fs-6">{{ $transaksi->kode_transaksi }}</span>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <th style="width: 200px;" class="text-muted">Nama Muzakki</th>
                            <td>: <span class="fw-bold">{{ $transaksi->muzakki->nama_lengkap ?? 'Muzakki Tidak Ditemukan' }}</span></td>
                        </tr>
                        <tr>
                            <th class="text-muted">Kode Muzakki</th>
                            <td>: {{ $transaksi->muzakki->kode_muzakki ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted">Jenis Zakat</th>
                            <td>: {{ $transaksi->jenis_zakat }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted">Nominal Pembayaran</th>
                            <td>: <span class="text-success fw-bold">Rp {{ number_format($transaksi->nominal, 0, ',', '.') }}</span></td>
                        </tr>
                        <tr>
                            <th class="text-muted">Metode Pembayaran</th>
                            <td>: {{ $transaksi->metode_pembayaran }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted">Tanggal Pembayaran</th>
                            <td>: {{ $transaksi->tanggal_bayar->format('d F Y') }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted">Keterangan</th>
                            <td>: {{ $transaksi->keterangan ?: '-' }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted">Waktu Pencatatan</th>
                            <td>: {{ $transaksi->created_at->format('d M Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted">Terakhir Diperbarui</th>
                            <td>: {{ $transaksi->updated_at->format('d M Y H:i') }}</td>
                        </tr>
                    </tbody>
                </table>

                <hr>

                <div class="d-flex gap-2 mt-4">
                    <a href="{{ route('admin.transaksi.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <a href="{{ route('admin.transaksi.edit', $transaksi->id) }}" class="btn btn-warning text-white">
                        <i class="bi bi-pencil-square"></i> Edit
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
