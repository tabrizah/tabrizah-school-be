<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Classes;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition()
    {
        return [
            'nisn' => $this->faker->unique()->numerify('#########'),
            'name' => null, // Akan diatur sesuai nama User
            'user_id' => User::factory()->create()->id, // Buat user terkait
            'teacher_id' => Teacher::factory()->create()->id, // Buat teacher terkait
            'class_id' => null, // Akan diisi kemudian jika ada class
        ];
    }

    public function configure()
    {
        return $this->afterMaking(function (Student $student) {
            $student->name = $student->user->name;
        });
    }
}