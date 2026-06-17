@extends('layouts.app')

@section('header', 'Kelola Data Mustahik')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Mustahik</h6>
        <a href="{{ route('amil.mustahik.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Tambah Data
        </a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('amil.mustahik.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan Kode atau Nama Mustahik..." value="{{ $search }}">
                <button class="btn btn-outline-secondary" type="submit">Cari</button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Kode Mustahik</th>
                        <th>Nama Lengkap</th>
                        <th>Kategori Asnaf</th>
                        <th>No. Telepon</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($mustahiks as $index => $mustahik)
                        <tr>
                            <td>{{ $mustahiks->firstItem() + $index }}</td>
                            <td><span class="badge bg-secondary">{{ $mustahik->kode_mustahik }}</span></td>
                            <td>{{ $mustahik->nama_lengkap }}</td>
                            <td>{{ $mustahik->kategori_asnaf }}</td>
                            <td>{{ $mustahik->nomor_telepon }}</td>
                            <td>
                                @if($mustahik->status_aktif == 'Aktif')
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-danger">Tidak Aktif</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('amil.mustahik.show', $mustahik->id) }}" class="btn btn-info btn-sm text-white" title="Detail">Detail</a>
                                <a href="{{ route('amil.mustahik.edit', $mustahik->id) }}" class="btn btn-warning btn-sm text-white" title="Edit">Edit</a>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $mustahik->id }}" title="Hapus">
                                    Hapus
                                </button>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $mustahik->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $mustahik->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $mustahik->id }}">Konfirmasi Hapus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus data mustahik <strong>{{ $mustahik->nama_lengkap }}</strong>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <form action="{{ route('amil.mustahik.destroy', $mustahik->id) }}" method="POST" class="d-inline">
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
                            <td colspan="7" class="text-center text-muted">Data mustahik tidak ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-end mt-3">
            {{ $mustahiks->withQueryString()->links() }}
        </div>
    </div>
</div>
@endsection
