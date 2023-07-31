<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->rich()->create([
            'name' => 'Mel Mathew Palana',
            'email' => 'melpalana13@gmail.com',
            'phone_number' => '+639275393573',
            'role' => 'admin',
        ]);

        User::factory()->sequence(
            ['role' => 'seller'],
            ['role' => 'customer'],
        )->count(10)->create();

        User::factory()->poor()->create();
    }
}
