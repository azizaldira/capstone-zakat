<?php

namespace Database\Factories;

use App\Models\Mustahik;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Mustahik>
 */
class MustahikFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $number = 1;
        return [
            'kode_mustahik' => 'MSH' . str_pad($number++, 4, '0', STR_PAD_LEFT),
            'nama_lengkap' => fake()->name(),
            'jenis_kelamin' => fake()->randomElement(['L', 'P']),
            'nomor_telepon' => fake()->phoneNumber(),
            'alamat' => fake()->address(),
            'kategori_asnaf' => fake()->randomElement(['Fakir', 'Miskin', 'Amil', 'Mualaf', 'Riqab', 'Gharim', 'Fisabilillah', 'Ibnu Sabil']),
            'status_aktif' => fake()->randomElement(['Aktif', 'Tidak Aktif']),
            'keterangan' => fake()->optional()->sentence(),
        ];
    }
}
