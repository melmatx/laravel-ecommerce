<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Mel Mathew Palana',
            'email' => 'melpalana13@gmail.com',
            'phone_number' => '+639275393573',
            'password' => bcrypt('12'),
            'role' => 'admin',
        ]);

        User::factory()->sequence(
            ['role' => 'seller'],
            ['role' => 'customer'],
        )->count(10)->create();
    }
}
