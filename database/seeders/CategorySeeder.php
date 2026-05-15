<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::insert([
            ['name' => 'Workout',   'color' => '#0d6efd', 'icon' => 'fa-solid fa-dumbbell',      'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Diet Plan', 'color' => '#198754', 'icon' => 'fa-solid fa-apple-whole',    'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Medical',   'color' => '#dc3545', 'icon' => 'fa-solid fa-stethoscope',    'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Hydration', 'color' => '#0dcaf0', 'icon' => 'fa-solid fa-droplet',        'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Exercise',  'color' => '#fd7e14', 'icon' => 'fa-solid fa-person-running', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}