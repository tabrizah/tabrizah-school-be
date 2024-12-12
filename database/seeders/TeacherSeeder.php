<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Teacher;

class TeacherSeeder extends Seeder
{
    public function run()
    {
       // Ambil semua user
        $users = User::all();

        foreach ($users as $user) {
            // Cek apakah teacher untuk user ini sudah ada
            if (!$user->teacher) {
                Teacher::create([
                    'user_id' => $user->id,
                    'name' => $user->name,
                ]);
            }
        }
    }
}