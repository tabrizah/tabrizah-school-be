<?php

namespace App\Repositories;

use App\Models\UserProfile;
use App\Interfaces\Repositories\UserProfileRepositoryInterface;

class UserProfileRepository implements UserProfileRepositoryInterface
{
    public function create(array $data): UserProfile
    {
        return UserProfile::create([
            'user_id' => $data['user_id'],
            'nik' => $data['nik'],
            'full_name' => $data['full_name'],
            'birth_date' => $data['birth_date'],
            'birth_place' => $data['birth_place'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'emergency_contact' => $data['emergency_contact'],
            'photo' => $data['photo'],
            'active' => $data['active'] ?? true,
        ]);
    }

    public function update(UserProfile $profile, array $data): UserProfile
    {
        $profile->update($data);
        return $profile->fresh();
    }

    public function findByUserId(int $userId): ?UserProfile
    {
        return UserProfile::where('user_id', $userId)->first();
    }

    public function findById(int $id): ?UserProfile
    {
        return UserProfile::find($id);
    }
}