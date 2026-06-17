<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiZakat extends Model
{
    /** @use HasFactory<\Database\Factories\TransaksiZakatFactory> */
    use HasFactory;

    protected $fillable = [
        'kode_transaksi',
        'muzakki_id',
        'jenis_zakat',
        'nominal',
        'metode_pembayaran',
        'tanggal_bayar',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_bayar' => 'date',
    ];

    public function muzakki()
    {
        return $this->belongsTo(Muzakki::class);
    }

    protected static function booted(): void
    {
        static::creating(function (TransaksiZakat $transaksi) {
            if (empty($transaksi->kode_transaksi)) {
                $latest = self::latest('id')->first();
                if ($latest && preg_match('/^TRX(\d+)$/', $latest->kode_transaksi, $matches)) {
                    $number = intval($matches[1]) + 1;
                } else {
                    $number = 1;
                }
                $transaksi->kode_transaksi = 'TRX' . str_pad($number, 6, '0', STR_PAD_LEFT);
            }
        });
    }
}
