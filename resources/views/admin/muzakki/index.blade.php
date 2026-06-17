@extends('layouts.app')

@section('header', 'Kelola Data Muzakki')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Muzakki</h6>
        <a href="{{ route('admin.muzakki.create') }}" class="btn btn-primary btn-sm">
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

        <form action="{{ route('admin.muzakki.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan Nama atau Kode Muzakki..." value="{{ $search }}">
                <button class="btn btn-outline-secondary" type="submit">Cari</button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Kode Muzakki</th>
                        <th>Nama Lengkap</th>
                        <th>Jenis Kelamin</th>
                        <th>No. Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($muzakkis as $index => $muzakki)
                        <tr>
                            <td>{{ $muzakkis->firstItem() + $index }}</td>
                            <td><span class="badge bg-secondary">{{ $muzakki->kode_muzakki }}</span></td>
                            <td>{{ $muzakki->nama_lengkap }}</td>
                            <td>{{ $muzakki->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                            <td>{{ $muzakki->nomor_telepon }}</td>
                            <td>
                                <a href="{{ route('admin.muzakki.show', $muzakki->id) }}" class="btn btn-info btn-sm text-white">Detail</a>
                                <a href="{{ route('admin.muzakki.edit', $muzakki->id) }}" class="btn btn-warning btn-sm text-white">Edit</a>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $muzakki->id }}">
                                    Hapus
                                </button>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $muzakki->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $muzakki->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $muzakki->id }}">Konfirmasi Hapus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus muzakki <strong>{{ $muzakki->nama_lengkap }}</strong>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <form action="{{ route('admin.muzakki.destroy', $muzakki->id) }}" method="POST" class="d-inline">
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
                            <td colspan="6" class="text-center text-muted">Data muzakki tidak ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-end mt-3">
            {{ $muzakkis->withQueryString()->links() }}
        </div>
    </div>
</div>
@endsection
