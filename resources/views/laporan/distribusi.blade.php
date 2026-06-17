@extends('layouts.app')

@section('header', 'Laporan Distribusi Zakat')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Filter Laporan Distribusi</h6>
    </div>
    <div class="card-body">
        @php
            $route = auth()->user()->role === 'admin_panitia' ? 'admin.laporan.distribusi' : 'amil.laporan.distribusi';
            $cetakRoute = auth()->user()->role === 'admin_panitia' ? 'admin.laporan.distribusi.cetak' : 'amil.laporan.distribusi.cetak';
        @endphp
        <form action="{{ route($route) }}" method="GET" class="row align-items-end">
            <div class="col-md-4 mb-3">
                <label for="start_date" class="form-label">Tanggal Awal</label>
                <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date" value="{{ old('start_date', $startDate) }}" required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="end_date" class="form-label">Tanggal Akhir</label>
                <input type="date" class="form-control @error('end_date') is-invalid @enderror" id="end_date" name="end_date" value="{{ old('end_date', $endDate) }}" required>
                @error('end_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <button type="submit" class="btn btn-primary"><i class="bi bi-filter"></i> Tampilkan</button>
                <a href="{{ route($cetakRoute, ['start_date' => $startDate, 'end_date' => $endDate]) }}" target="_blank" class="btn btn-success"><i class="bi bi-printer"></i> Cetak PDF</a>
            </div>
        </form>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Data Distribusi ({{ date('d M Y', strtotime($startDate)) }} - {{ date('d M Y', strtotime($endDate)) }})</h6>
        <span class="badge bg-warning text-dark fs-6">Total Disalurkan: Rp {{ number_format($totalNominal, 0, ',', '.') }}</span>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Tanggal</th>
                        <th>Mustahik</th>
                        <th>Asnaf</th>
                        <th>Kategori Bantuan</th>
                        <th>Nominal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->kode_distribusi }}</td>
                            <td>{{ $item->tanggal_distribusi->format('d/m/Y') }}</td>
                            <td>{{ $item->mustahik->nama_lengkap ?? '-' }}</td>
                            <td>{{ $item->mustahik->kategori_asnaf ?? '-' }}</td>
                            <td>{{ $item->kategori_bantuan }}</td>
                            <td class="text-end text-danger fw-bold">Rp {{ number_format($item->nominal_distribusi, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Tidak ada data distribusi pada periode ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
