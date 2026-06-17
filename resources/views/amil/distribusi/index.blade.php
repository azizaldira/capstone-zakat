@extends('layouts.app')

@section('header', 'Kelola Distribusi Zakat')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Distribusi Zakat</h6>
        <a href="{{ route('amil.distribusi.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Tambah Distribusi
        </a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('amil.distribusi.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan Kode Distribusi atau Nama Mustahik..." value="{{ $search }}">
                <button class="btn btn-outline-secondary" type="submit">Cari</button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Kode Distribusi</th>
                        <th>Nama Mustahik</th>
                        <th>Kategori Bantuan</th>
                        <th>Nominal Distribusi</th>
                        <th>Tanggal Distribusi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($distribusis as $index => $distribusi)
                        <tr>
                            <td>{{ $distribusis->firstItem() + $index }}</td>
                            <td><span class="badge bg-secondary">{{ $distribusi->kode_distribusi }}</span></td>
                            <td>{{ $distribusi->mustahik->nama_lengkap ?? 'Mustahik Tidak Ditemukan' }}</td>
                            <td>{{ $distribusi->kategori_bantuan }}</td>
                            <td>Rp {{ number_format($distribusi->nominal_distribusi, 0, ',', '.') }}</td>
                            <td>{{ $distribusi->tanggal_distribusi->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('amil.distribusi.show', $distribusi->id) }}" class="btn btn-info btn-sm text-white" title="Detail">Detail</a>
                                <a href="{{ route('amil.distribusi.edit', $distribusi->id) }}" class="btn btn-warning btn-sm text-white" title="Edit">Edit</a>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $distribusi->id }}" title="Hapus">
                                    Hapus
                                </button>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $distribusi->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $distribusi->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $distribusi->id }}">Konfirmasi Hapus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus data distribusi <strong>{{ $distribusi->kode_distribusi }}</strong> untuk mustahik <strong>{{ $distribusi->mustahik->nama_lengkap ?? '-' }}</strong>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <form action="{{ route('amil.distribusi.destroy', $distribusi->id) }}" method="POST" class="d-inline">
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
                            <td colspan="7" class="text-center text-muted">Data distribusi zakat tidak ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-end mt-3">
            {{ $distribusis->withQueryString()->links() }}
        </div>
    </div>
</div>
@endsection
