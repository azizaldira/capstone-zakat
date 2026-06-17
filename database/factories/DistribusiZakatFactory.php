<?php

namespace Database\Factories;

use App\Models\DistribusiZakat;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<DistribusiZakat>
 */
class DistribusiZakatFactory extends Factory
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
            'kode_distribusi' => 'DST' . str_pad($number++, 6, '0', STR_PAD_LEFT),
            'mustahik_id' => \App\Models\Mustahik::inRandomOrder()->first()->id ?? \App\Models\Mustahik::factory(),
            'nominal_distribusi' => fake()->randomElement([500000, 1000000, 1500000, 2000000, 3000000]),
            'tanggal_distribusi' => fake()->dateTimeBetween('-1 year', 'now'),
            'kategori_bantuan' => fake()->randomElement(['Zakat Fitrah', 'Zakat Mal', 'Bantuan Pendidikan', 'Bantuan Kesehatan', 'Bantuan Sosial', 'Bantuan Darurat']),
            'keterangan' => fake()->optional()->sentence(),
        ];
    }
}
