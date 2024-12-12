<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Classes;

class ClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classNames = ['A', 'B', 'C', 'D', 'E'];

        foreach ($classNames as $name) {
            Classes::factory()->create(['name' => $name]);
        }
    }
}
