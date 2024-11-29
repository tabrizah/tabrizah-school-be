<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Classes;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Seeder untuk membuat beberapa kelas
        $classA = Classes::create([
            'name' => 'Class A'
        ]);
        
        $classB = Classes::create([
            'name' => 'Class B'
        ]);

        // Seeder untuk membuat User dan relasi ke Student/Teacher
        $userStudent = User::create([
            'name' => 'John Doe',
            'email' => 'johndoe@student.com',
            'password' => bcrypt('password123')
        ]);

        $userTeacher = User::create([
            'name' => 'Jane Smith',
            'email' => 'janesmith@teacher.com',
            'password' => bcrypt('password123')
        ]);

        // Seeder untuk membuat Teacher dan relasi ke User
        // Mengambil nama dari user dan menetapkan ke teacher
        $teacher = Teacher::create([
            'name' => $userTeacher->name,  // Pastikan nama diambil dari user
            'user_id' => $userTeacher->id,
            'class_id' => $classA->id, // Relasikan dengan kelas yang ada
        ]);

        // Membuat student dan menghubungkannya dengan teacher yang menjadi wali kelas
        $student = Student::create([
            'nisn' => '1234567890',
            'name' => $userStudent->name,
            'class_id' => $classA->id, // Relasikan dengan kelas yang ada
            'user_id' => $userStudent->id, // Relasikan dengan User
            'teacher_id' => $teacher->id, // Relasikan dengan Teacher
        ]);

        // Seeder untuk membuat beberapa user lainnya jika diperlukan
        $user2 = User::create([
            'name' => 'Mark Johnson',
            'email' => 'mark.johnson@student.com',
            'password' => bcrypt('password123')
        ]);

        $student2 = Student::create([
            'nisn' => '9876543210',
            'name' => $user2->name,
            'class_id' => $classB->id,
            'user_id' => $user2->id,
            'teacher_id' => $teacher->id, // Asumsikan teacher yang sama untuk class B
        ]);
    }
}