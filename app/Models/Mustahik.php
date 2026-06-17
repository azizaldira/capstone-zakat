<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mustahik extends Model
{
    /** @use HasFactory<\Database\Factories\MustahikFactory> */
    use HasFactory;

    protected $fillable = [
        'kode_mustahik',
        'nama_lengkap',
        'jenis_kelamin',
        'nomor_telepon',
        'alamat',
        'kategori_asnaf',
        'status_aktif',
        'keterangan',
    ];

    protected static function booted(): void
    {
        static::creating(function (Mustahik $mustahik) {
            if (empty($mustahik->kode_mustahik)) {
                $latest = self::latest('id')->first();
                if ($latest && preg_match('/^MSH(\d+)$/', $latest->kode_mustahik, $matches)) {
                    $number = intval($matches[1]) + 1;
                } else {
                    $number = 1;
                }
                $mustahik->kode_mustahik = 'MSH' . str_pad($number, 4, '0', STR_PAD_LEFT);
            }
        });
    }
}
