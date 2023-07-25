<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Computers',
            'Mobile & Accessories',
            'Gaming',
            'Cameras & Photography',
            'Audio & Video',
            'Office Electronics & Supplies',
        ];

        for ($i = 0; $i < count($categories); $i++) {
            Category::create([
                'name' => $categories[$i],
            ]);
        }
    }
}
