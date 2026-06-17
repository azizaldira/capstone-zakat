<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Muzakki extends Model
{
    /** @use HasFactory<\Database\Factories\MuzakkiFactory> */
    use HasFactory;

    protected $fillable = [
        'kode_muzakki',
        'nama_lengkap',
        'jenis_kelamin',
        'nomor_telepon',
        'email',
        'alamat',
    ];

    public function transaksiZakat()
    {
        return $this->hasMany(TransaksiZakat::class);
    }

    protected static function booted(): void
    {
        static::creating(function (Muzakki $muzakki) {
            if (empty($muzakki->kode_muzakki)) {
                $latest = self::latest('id')->first();
                if ($latest && preg_match('/^MZK(\d+)$/', $latest->kode_muzakki, $matches)) {
                    $number = intval($matches[1]) + 1;
                } else {
                    $number = 1;
                }
                $muzakki->kode_muzakki = 'MZK' . str_pad($number, 4, '0', STR_PAD_LEFT);
            }
        });
    }
}
