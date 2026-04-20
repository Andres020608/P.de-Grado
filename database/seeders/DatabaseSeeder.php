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
        // Admin de prueba
        User::factory()->create([
            'name' => 'Administrador',
            'email' => 'admin@jessica.com',
            'password' => \Hash::make('admin123'),
            'role' => User::ROLE_ADMIN,
        ]);

        // Cliente de prueba
        User::factory()->create([
            'name' => 'Cliente Test',
            'email' => 'cliente@test.com',
            'password' => \Hash::make('cliente123'),
            'role' => User::ROLE_CLIENT,
        ]);
    }
}
