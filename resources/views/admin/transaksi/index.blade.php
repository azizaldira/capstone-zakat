@extends('layouts.app')

@section('header', 'Kelola Transaksi Zakat')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Transaksi Zakat</h6>
        <a href="{{ route('admin.transaksi.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Tambah Transaksi
        </a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('admin.transaksi.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan Kode Transaksi atau Nama Muzakki..." value="{{ $search }}">
                <button class="btn btn-outline-secondary" type="submit">Cari</button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table  table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Kode Transaksi</th>
                        <th>Nama Muzakki</th>
                        <th>Jenis Zakat</th>
                        <th>Nominal</th>
                        <th>Metode</th>
                        <th>Tanggal Bayar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transaksis as $index => $transaksi)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><span class="badge bg-secondary">{{ $transaksi->kode_transaksi }}</span></td>
                            <td>{{ $transaksi->muzakki->nama_lengkap ?? 'Tidak Diketahui' }}</td>
                            <td>{{ $transaksi->jenis_zakat }}</td>
                            <td>Rp {{ number_format($transaksi->nominal, 0, ',', '.') }}</td>
                            <td>{{ $transaksi->metode_pembayaran }}</td>
                            <td>{{ $transaksi->tanggal_bayar->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('admin.transaksi.show', $transaksi->id) }}" class="btn btn-info btn-sm text-white" title="Detail">Detail</a>
                                <a href="{{ route('admin.transaksi.edit', $transaksi->id) }}" class="btn btn-warning btn-sm text-white" title="Edit">Edit</a>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $transaksi->id }}" title="Hapus">
                                    Hapus
                                </button>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $transaksi->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $transaksi->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $transaksi->id }}">Konfirmasi Hapus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus transaksi <strong>{{ $transaksi->kode_transaksi }}</strong> atas nama <strong>{{ $transaksi->muzakki->nama_lengkap ?? '-' }}</strong>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <form action="{{ route('admin.transaksi.destroy', $transaksi->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">Data transaksi tidak ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
    </div>
</div>
@endsection
