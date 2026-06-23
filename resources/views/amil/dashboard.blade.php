@extends('layouts.app')

@section('header', 'Dashboard Amil')

@section('content')
<div class="container-fluid">
    <!-- Row 1: Key Metrics -->
    <div class="row">
        <!-- Total Mustahik -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 border-start border-4 border-primary h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Mustahik</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($totalMustahik) }} Orang</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-people fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mustahik Aktif -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 border-start border-4 border-success h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Mustahik Aktif</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($mustahikAktif) }} Orang</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-person-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Distribusi -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 border-start border-4 border-warning h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Frekuensi Distribusi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($totalDistribusi) }} Kali</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-box-seam fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Dana Tersalurkan -->
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
    </div>

    <!-- Row 2: Charts and Tables -->
    <div class="row">
        <!-- Area Chart Distribusi -->
        <div class="col-lg-7 mb-4">
            <div class="card border-0 mb-4 h-100">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-white">
                    <h6 class="m-0 font-weight-bold text-info">Grafik Distribusi Dana ({{ date('Y') }})</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area" style="height: 300px;">
                        <canvas id="chartDistribusiAmil"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Distribusi Terbaru -->
        <div class="col-lg-5 mb-4">
            <div class="card border-0 mb-4 h-100">
                <div class="card-header py-3 bg-white">
                    <h6 class="m-0 font-weight-bold text-primary">5 Distribusi Terbaru</h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover table-striped mb-0">
                            <thead class="table-light text-muted">
                                <tr>
                                    <th>Mustahik</th>
                                    <th>Kategori</th>
                                    <th>Nominal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($distribusiTerbaru as $dst)
                                <tr>
                                    <td>
                                        <div class="fw-bold">{{ $dst->mustahik->nama_lengkap ?? '-' }}</div>
                                        <div class="small text-muted">{{ $dst->kode_distribusi }}</div>
                                    </td>
                                    <td class="align-middle">{{ $dst->kategori_bantuan }}</td>
                                    <td class="align-middle text-info fw-bold">Rp {{ number_format($dst->nominal_distribusi, 0, ',', '.') }}</td>
                                </tr>
                                @empty
                                <tr><td colspan="3" class="text-center">Belum ada distribusi.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="p-3 text-center">
                        <a href="{{ route('amil.distribusi.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua Distribusi</a>
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
    
    // Chart Distribusi Amil
    const ctxDistribusi = document.getElementById('chartDistribusiAmil').getContext('2d');
    new Chart(ctxDistribusi, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Dana Disalurkan (Rp)',
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
