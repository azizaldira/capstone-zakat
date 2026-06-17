<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin Panitia',
            'email' => 'admin@almadani.test',
            'password' => bcrypt('password123'),
            'role' => 'admin_panitia',
        ]);

        User::factory()->create([
            'name' => 'Amil Zakat',
            'email' => 'amil@almadani.test',
            'password' => bcrypt('password123'),
            'role' => 'amil',
        ]);

        $this->call([
            MuzakkiSeeder::class,
            TransaksiZakatSeeder::class,
        ]);
    }
}
