<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password'),
                'is_admin' => true,
            ]
        );

        User::firstOrCreate(
            ['email' => 'makara.pon@student.passerellesnumeriques.org'],
            [
                'name' => 'Makara',
                'password' => bcrypt('password'),
                'is_admin' => true,
            ]
        );

        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
        ]);
    }
}
