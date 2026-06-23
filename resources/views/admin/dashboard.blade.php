@extends('layouts.app')

@section('header', 'Dashboard Admin Panitia')

@section('content')
<div class="container-fluid">
    <!-- Row 1: Key Metrics -->
    <div class="row">
        <!-- Dana Masuk -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 border-start border-4 border-success h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Dana Masuk</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($totalDanaMasuk, 0, ',', '.') }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-wallet2 fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dana Tersalurkan -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 border-start border-4 border-info h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Dana Tersalurkan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($totalDanaTersalurkan, 0, ',', '.') }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-cash-stack fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sisa Dana -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 border-start border-4 border-primary h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Sisa Kas</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($sisaDana, 0, ',', '.') }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-safe fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Transaksi -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 border-start border-4 border-warning h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Transaksi Zakat</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($totalTransaksi) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-receipt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Row 2: Secondary Metrics -->
    <div class="row">
        <!-- Total Muzakki -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-success text-white border-0 h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Total Muzakki</div>
                            <div class="h5 mb-0 font-weight-bold">{{ number_format($totalMuzakki) }} Orang</div>
                        </div>
                        <div class="col-auto"><i class="bi bi-people fa-2x opacity-50"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Mustahik -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-info text-white border-0 h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Total Mustahik</div>
                            <div class="h5 mb-0 font-weight-bold">{{ number_format($totalMustahik) }} Orang</div>
                        </div>
                        <div class="col-auto"><i class="bi bi-people-fill fa-2x opacity-50"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Distribusi -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-secondary text-white border-0 h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Frekuensi Penyaluran</div>
                            <div class="h5 mb-0 font-weight-bold">{{ number_format($totalDistribusi) }} Kali</div>
                        </div>
                        <div class="col-auto"><i class="bi bi-box-seam fa-2x opacity-50"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Widget: Jenis Zakat & Bantuan -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h6 class="font-weight-bold text-dark mb-3">Tren Terbanyak</h6>
                    <div class="mb-2">
                        <small class="text-muted d-block">Jenis Zakat Masuk</small>
                        <span class="badge bg-success">{{ $jenisZakatTerbanyak->jenis_zakat ?? '-' }}</span>
                    </div>
                    <div>
                        <small class="text-muted d-block">Kategori Bantuan Keluar</small>
                        <span class="badge bg-info">{{ $kategoriBantuanTerbanyak->kategori_bantuan ?? '-' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Row 3: Charts -->
    <div class="row">
        <!-- Area Chart Penerimaan -->
        <div class="col-xl-6 col-lg-6 mb-4">
            <div class="card border-0 mb-4 h-100">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-white">
                    <h6 class="m-0 font-weight-bold text-success">Grafik Penerimaan Zakat ({{ date('Y') }})</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area" style="height: 300px;">
                        <canvas id="chartPenerimaan"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Area Chart Distribusi -->
        <div class="col-xl-6 col-lg-6 mb-4">
            <div class="card shadow mb-4 h-100">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-info">Grafik Distribusi Dana ({{ date('Y') }})</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area" style="height: 300px;">
                        <canvas id="chartDistribusi"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Row 4: Latest Tables -->
    <div class="row">
        <!-- Transaksi Terbaru -->
        <div class="col-lg-6 mb-4">
            <div class="card border-0 mb-4">
                <div class="card-header py-3 bg-white">
                    <h6 class="m-0 font-weight-bold text-primary">5 Transaksi Zakat Terbaru</h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover table-striped mb-0">
                            <thead class="table-light text-muted">
                                <tr>
                                    <th>Kode</th>
                                    <th>Muzakki</th>
                                    <th>Jenis</th>
                                    <th>Nominal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($transaksiTerbaru as $trx)
                                <tr>
                                    <td><span class="badge bg-secondary">{{ $trx->kode_transaksi }}</span></td>
                                    <td>{{ $trx->muzakki->nama_lengkap ?? '-' }}</td>
                                    <td>{{ $trx->jenis_zakat }}</td>
                                    <td class="text-success">Rp {{ number_format($trx->nominal, 0, ',', '.') }}</td>
                                </tr>
                                @empty
                                <tr><td colspan="4" class="text-center">Belum ada transaksi.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Distribusi Terbaru -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">5 Distribusi Terbaru</h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover table-striped mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Kode</th>
                                    <th>Mustahik</th>
                                    <th>Kategori</th>
                                    <th>Nominal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($distribusiTerbaru as $dst)
                                <tr>
                                    <td><span class="badge bg-secondary">{{ $dst->kode_distribusi }}</span></td>
                                    <td>{{ $dst->mustahik->nama_lengkap ?? '-' }}</td>
                                    <td>{{ $dst->kategori_bantuan }}</td>
                                    <td class="text-info">Rp {{ number_format($dst->nominal_distribusi, 0, ',', '.') }}</td>
                                </tr>
                                @empty
                                <tr><td colspan="4" class="text-center">Belum ada distribusi.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function() {
    const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
    
    // Chart Penerimaan
    const ctxPenerimaan = document.getElementById('chartPenerimaan').getContext('2d');
    new Chart(ctxPenerimaan, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Dana Masuk (Rp)',
                data: {!! json_encode($chartPenerimaan) !!},
                backgroundColor: 'rgba(25, 135, 84, 0.2)',
                borderColor: 'rgba(25, 135, 84, 1)',
                borderWidth: 2,
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                        }
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return 'Rp ' + new Intl.NumberFormat('id-ID').format(context.raw);
                        }
                    }
                }
            }
        }
    });

    // Chart Distribusi
    const ctxDistribusi = document.getElementById('chartDistribusi').getContext('2d');
    new Chart(ctxDistribusi, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Dana Keluar (Rp)',
                data: {!! json_encode($chartDistribusi) !!},
                backgroundColor: 'rgba(13, 202, 240, 0.6)',
                borderColor: 'rgba(13, 202, 240, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                        }
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return 'Rp ' + new Intl.NumberFormat('id-ID').format(context.raw);
                        }
                    }
                }
            }
        }
    });
});
</script>
@endpush
@endsection
