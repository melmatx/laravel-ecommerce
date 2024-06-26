<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Address::factory()->create([
            'user_id' => 1,
            'street' => 'Balacat Ave',
            'city' => 'Mabalacat',
            'state' => 'Pampanga',
            'country' => 'Philippines',
            'zip_code' => '2010',
        ]);

        User::cursor()->skip(1)->each(function ($user) {
            Address::factory()->create([
                'user_id' => $user->id,
            ]);
        });
    }
}
