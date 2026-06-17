<?php

namespace Database\Factories;

use App\Models\Muzakki;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Muzakki>
 */
class MuzakkiFactory extends Factory
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
            'kode_muzakki' => 'MZK' . str_pad($number++, 4, '0', STR_PAD_LEFT),
            'nama_lengkap' => fake()->name(),
            'jenis_kelamin' => fake()->randomElement(['L', 'P']),
            'nomor_telepon' => fake()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'alamat' => fake()->address(),
        ];
    }
}
