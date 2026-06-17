<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistribusiZakat extends Model
{
    /** @use HasFactory<\Database\Factories\DistribusiZakatFactory> */
    use HasFactory;

    protected $fillable = [
        'kode_distribusi',
        'mustahik_id',
        'nominal_distribusi',
        'tanggal_distribusi',
        'kategori_bantuan',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_distribusi' => 'date',
    ];

    public function mustahik()
    {
        return $this->belongsTo(Mustahik::class);
    }

    protected static function booted(): void
    {
        static::creating(function (DistribusiZakat $distribusi) {
            if (empty($distribusi->kode_distribusi)) {
                $latest = self::latest('id')->first();
                if ($latest && preg_match('/^DST(\d+)$/', $latest->kode_distribusi, $matches)) {
                    $number = intval($matches[1]) + 1;
                } else {
                    $number = 1;
                }
                $distribusi->kode_distribusi = 'DST' . str_pad($number, 6, '0', STR_PAD_LEFT);
            }
        });
    }
}
