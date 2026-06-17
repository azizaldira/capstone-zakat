@extends('layouts.app')

@section('header', 'Kalkulator Zakat')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <ul class="nav nav-tabs card-header-tabs" id="kalkulatorTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active font-weight-bold" id="mal-tab" data-bs-toggle="tab" data-bs-target="#mal" type="button" role="tab" aria-controls="mal" aria-selected="true">Zakat Mal</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link font-weight-bold" id="penghasilan-tab" data-bs-toggle="tab" data-bs-target="#penghasilan" type="button" role="tab" aria-controls="penghasilan" aria-selected="false">Zakat Penghasilan</button>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="kalkulatorTabContent">
                    
                    <!-- TAB ZAKAT MAL -->
                    <div class="tab-pane fade show active" id="mal" role="tabpanel" aria-labelledby="mal-tab">
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle-fill me-2"></i> <strong>Informasi:</strong> Nisab Zakat Mal saat ini ditetapkan sebesar <strong>Rp {{ number_format($nisabMal, 0, ',', '.') }}</strong> (Setara 85 gram emas).
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="total_harta" class="form-label">Total Harta Keseluruhan (Rp)</label>
                                <input type="number" class="form-control kalkulator-input" id="total_harta" placeholder="0" min="0">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="total_hutang" class="form-label">Total Hutang Jatuh Tempo (Rp)</label>
                                <input type="number" class="form-control kalkulator-input" id="total_hutang" placeholder="0" min="0">
                            </div>
                        </div>

                        <div class="bg-light p-4 rounded-3 border mt-3 text-center">
                            <h6 class="text-muted text-uppercase mb-2">Harta Bersih</h6>
                            <h4 id="harta_bersih_text" class="font-weight-bold">Rp 0</h4>
                            
                            <hr>
                            
                            <h6 class="text-muted text-uppercase mb-2">Status</h6>
                            <div id="status_mal" class="badge bg-secondary p-2 px-3 fs-6 mb-3">Belum Memasukkan Data</div>
                            
                            <h6 class="text-muted text-uppercase mb-2">Estimasi Zakat yang Wajib Dikeluarkan</h6>
                            <h2 id="zakat_mal_text" class="font-weight-bold text-success mb-0">Rp 0</h2>
                        </div>
                    </div>

                    <!-- TAB ZAKAT PENGHASILAN -->
                    <div class="tab-pane fade" id="penghasilan" role="tabpanel" aria-labelledby="penghasilan-tab">
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle-fill me-2"></i> <strong>Informasi:</strong> Nisab Zakat Penghasilan per bulan saat ini ditetapkan sebesar <strong>Rp {{ number_format($nisabPenghasilan, 0, ',', '.') }}</strong>.
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="penghasilan_bulanan" class="form-label">Penghasilan Bulanan (Rp)</label>
                                <input type="number" class="form-control kalkulator-input" id="penghasilan_bulanan" placeholder="0" min="0">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="pengeluaran_pokok" class="form-label">Pengeluaran Pokok / Hutang (Rp)</label>
                                <input type="number" class="form-control kalkulator-input" id="pengeluaran_pokok" placeholder="0" min="0">
                            </div>
                        </div>

                        <div class="bg-light p-4 rounded-3 border mt-3 text-center">
                            <h6 class="text-muted text-uppercase mb-2">Penghasilan Bersih (Per Bulan)</h6>
                            <h4 id="penghasilan_bersih_text" class="font-weight-bold">Rp 0</h4>
                            
                            <hr>
                            
                            <h6 class="text-muted text-uppercase mb-2">Status</h6>
                            <div id="status_penghasilan" class="badge bg-secondary p-2 px-3 fs-6 mb-3">Belum Memasukkan Data</div>
                            
                            <h6 class="text-muted text-uppercase mb-2">Estimasi Zakat yang Wajib Dikeluarkan</h6>
                            <h2 id="zakat_penghasilan_text" class="font-weight-bold text-success mb-0">Rp 0</h2>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function() {
    const formatRp = (angka) => {
        return 'Rp ' + new Intl.NumberFormat('id-ID').format(angka);
    };

    // Zakat Mal
    const nisabMal = {{ $nisabMal }};
    const inputTotalHarta = document.getElementById('total_harta');
    const inputTotalHutang = document.getElementById('total_hutang');
    const textHartaBersih = document.getElementById('harta_bersih_text');
    const statusMal = document.getElementById('status_mal');
    const textZakatMal = document.getElementById('zakat_mal_text');

    const hitungZakatMal = () => {
        const harta = parseFloat(inputTotalHarta.value) || 0;
        const hutang = parseFloat(inputTotalHutang.value) || 0;
        
        let hartaBersih = harta - hutang;
        if(hartaBersih < 0) hartaBersih = 0;
        
        textHartaBersih.innerText = formatRp(hartaBersih);

        if (hartaBersih === 0 && harta === 0) {
            statusMal.className = 'badge bg-secondary p-2 px-3 fs-6 mb-3';
            statusMal.innerText = 'Belum Memasukkan Data';
            textZakatMal.innerText = 'Rp 0';
        } else if (hartaBersih >= nisabMal) {
            statusMal.className = 'badge bg-success p-2 px-3 fs-6 mb-3';
            statusMal.innerText = 'Wajib Zakat (Telah Mencapai Nisab)';
            const zakat = hartaBersih * 0.025;
            textZakatMal.innerText = formatRp(zakat);
        } else {
            statusMal.className = 'badge bg-warning text-dark p-2 px-3 fs-6 mb-3';
            statusMal.innerText = 'Belum Wajib Zakat (Di Bawah Nisab)';
            textZakatMal.innerText = 'Rp 0';
        }
    };

    inputTotalHarta.addEventListener('input', hitungZakatMal);
    inputTotalHutang.addEventListener('input', hitungZakatMal);

    // Zakat Penghasilan
    const nisabPenghasilan = {{ $nisabPenghasilan }};
    const inputPenghasilan = document.getElementById('penghasilan_bulanan');
    const inputPengeluaran = document.getElementById('pengeluaran_pokok');
    const textPenghasilanBersih = document.getElementById('penghasilan_bersih_text');
    const statusPenghasilan = document.getElementById('status_penghasilan');
    const textZakatPenghasilan = document.getElementById('zakat_penghasilan_text');

    const hitungZakatPenghasilan = () => {
        const pendapatan = parseFloat(inputPenghasilan.value) || 0;
        const pengeluaran = parseFloat(inputPengeluaran.value) || 0;
        
        let penghasilanBersih = pendapatan - pengeluaran;
        if(penghasilanBersih < 0) penghasilanBersih = 0;
        
        textPenghasilanBersih.innerText = formatRp(penghasilanBersih);

        if (penghasilanBersih === 0 && pendapatan === 0) {
            statusPenghasilan.className = 'badge bg-secondary p-2 px-3 fs-6 mb-3';
            statusPenghasilan.innerText = 'Belum Memasukkan Data';
            textZakatPenghasilan.innerText = 'Rp 0';
        } else if (penghasilanBersih >= nisabPenghasilan) {
            statusPenghasilan.className = 'badge bg-success p-2 px-3 fs-6 mb-3';
            statusPenghasilan.innerText = 'Wajib Zakat (Telah Mencapai Nisab)';
            const zakat = penghasilanBersih * 0.025;
            textZakatPenghasilan.innerText = formatRp(zakat);
        } else {
            statusPenghasilan.className = 'badge bg-warning text-dark p-2 px-3 fs-6 mb-3';
            statusPenghasilan.innerText = 'Belum Wajib Zakat (Di Bawah Nisab)';
            textZakatPenghasilan.innerText = 'Rp 0';
        }
    };

    inputPenghasilan.addEventListener('input', hitungZakatPenghasilan);
    inputPengeluaran.addEventListener('input', hitungZakatPenghasilan);
});
</script>
@endpush
@endsection
