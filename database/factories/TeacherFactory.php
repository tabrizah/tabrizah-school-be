<?php

namespace Database\Factories;

use App\Models\Teacher;
use App\Models\User;
use App\Models\Classes;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherFactory extends Factory
{
    protected $model = Teacher::class;

    public function definition()
    {

        $user = User::factory()->create();

        return [
            'name' => $user->name, // Akan diatur sesuai nama User
            'user_id' => $user->id, // Buat user terkait
            'class_id' => Classes::factory()->create()->id, // Akan diisi kemudian jika ada class
        ];
    }

    public function configure()
    {
        return $this->afterMaking(function (Teacher $teacher) {
            $teacher->name = $teacher->user->name; // Sinkronisasi nama dengan User
        });
    }
}