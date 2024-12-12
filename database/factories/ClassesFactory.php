<?php

namespace Database\Factories;

use App\Models\Classes;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClassesFactory extends Factory
{
    protected $model = Classes::class;

    public function definition()
    {
        $classNames = ['A', 'B', 'C', 'D', 'E'];

        return [
            'name' => $this->faker->randomElement($classNames),
        ];
    }
}