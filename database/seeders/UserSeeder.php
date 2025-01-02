<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserProfile;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Staff;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create Super Admin
        $superAdmin = User::create([
            'name' => 'Super Administrator',
            'email' => 'superadmin@school.com',
            'password' => Hash::make('password123'),
        ]);

        // UserProfile::create([
        //     'user_id' => $superAdmin->id,
        //     'full_name' => 'Super Administrator',
        //     'phone' => '081234567890',
        //     'birth_date' => '1990-01-01',
        //     'birth_place' => 'Jakarta',
        //     'address' => 'Jl. Admin No. 1',
        //     'active' => true,
        // ]);

        $superAdmin->assignRole('super-admin');
        $superAdmin->givePermissionTo(Permission::all());
    }
}