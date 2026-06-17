<?php

namespace Database\Factories;

use App\Models\TransaksiZakat;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<TransaksiZakat>
 */
class TransaksiZakatFactory extends Factory
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
            'kode_transaksi' => 'TRX' . str_pad($number++, 6, '0', STR_PAD_LEFT),
            'muzakki_id' => \App\Models\Muzakki::inRandomOrder()->first()->id ?? \App\Models\Muzakki::factory(),
            'jenis_zakat' => fake()->randomElement(['Zakat Fitrah', 'Zakat Mal', 'Infak', 'Sedekah']),
            'nominal' => fake()->randomElement([50000, 100000, 250000, 500000, 1000000]),
            'metode_pembayaran' => fake()->randomElement(['Tunai', 'Transfer Bank', 'E-Wallet']),
            'tanggal_bayar' => fake()->dateTimeBetween('-1 year', 'now'),
            'keterangan' => fake()->optional()->sentence(),
        ];
    }
}
