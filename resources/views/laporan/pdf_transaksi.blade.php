<!DOCTYPE html>
<html>
<head>
    <title>Laporan Transaksi Zakat</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .kop-surat { text-align: center; border-bottom: 3px solid #000; padding-bottom: 10px; margin-bottom: 20px; }
        .kop-surat h1 { margin: 0; font-size: 22px; text-transform: uppercase; }
        .kop-surat p { margin: 5px 0 0 0; font-size: 12px; }
        .info-laporan { margin-bottom: 20px; }
        .info-laporan table { width: 100%; }
        .info-laporan td { padding: 2px; }
        .table-data { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .table-data th, .table-data td { border: 1px solid #000; padding: 6px; text-align: left; }
        .table-data th { background-color: #f2f2f2; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .font-weight-bold { font-weight: bold; }
        .footer { width: 100%; margin-top: 50px; }
        .footer td { width: 33%; text-align: center; }
        .ttd-area { height: 80px; }
    </style>
</head>
<body>

    <div class="kop-surat">
        <h1>Masjid Al Madani</h1>
        <p>Jl. Contoh Alamat No. 123, Kota Simulasi, Provinsi Fiktif</p>
        <p>Email: info@almadani.test | Telp: (021) 12345678</p>
    </div>

    <div class="text-center" style="margin-bottom: 20px;">
        <h2 style="margin:0; font-size: 18px; text-decoration: underline;">LAPORAN TRANSAKSI ZIS</h2>
        <p style="margin:5px 0 0 0;">Nomor: REP-TRX-{{ date('Ymd-His') }}</p>
    </div>

    <div class="info-laporan">
        <table>
            <tr>
                <td style="width: 15%;"><strong>Periode</strong></td>
                <td>: {{ date('d M Y', strtotime($startDate)) }} s/d {{ date('d M Y', strtotime($endDate)) }}</td>
                <td style="width: 15%;" class="text-right"><strong>Tanggal Cetak</strong></td>
                <td style="width: 20%;" class="text-right">: {{ date('d M Y') }}</td>
            </tr>
            <tr>
                <td><strong>Total Data</strong></td>
                <td>: {{ $data->count() }} Transaksi</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td><strong>Total Nominal</strong></td>
                <td>: Rp {{ number_format($totalNominal, 0, ',', '.') }}</td>
                <td></td>
                <td></td>
            </tr>
        </table>
    </div>

    <table class="table-data">
        <thead>
            <tr>
                <th style="width: 5%; text-align: center;">No</th>
                <th style="width: 15%;">Kode Transaksi</th>
                <th style="width: 12%;">Tanggal</th>
                <th style="width: 25%;">Nama Muzakki</th>
                <th style="width: 15%;">Jenis Zakat</th>
                <th style="width: 13%;">Metode</th>
                <th style="width: 15%; text-align: right;">Nominal (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $item->kode_transaksi }}</td>
                    <td>{{ $item->tanggal_bayar->format('d/m/Y') }}</td>
                    <td>{{ $item->muzakki->nama_lengkap ?? '-' }}</td>
                    <td>{{ $item->jenis_zakat }}</td>
                    <td>{{ $item->metode_pembayaran }}</td>
                    <td class="text-right">{{ number_format($item->nominal, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak ada transaksi pada periode ini.</td>
                </tr>
            @endforelse
            @if($data->count() > 0)
                <tr>
                    <th colspan="6" class="text-right">TOTAL</th>
                    <th class="text-right">{{ number_format($totalNominal, 0, ',', '.') }}</th>
                </tr>
            @endif
        </tbody>
    </table>

    <table class="footer">
        <tr>
            <td></td>
            <td></td>
            <td>
                Mengetahui,<br>
                <strong>Admin Panitia</strong>
                <div class="ttd-area"></div>
                <u>{{ auth()->user()->name }}</u>
            </td>
        </tr>
    </table>

</body>
</html>
