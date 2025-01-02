<?php

namespace App\Interfaces\Services;

use App\Models\UserProfile;

interface UserProfileServiceInterface
{
    public function createProfile(array $data): UserProfile;
    public function updateProfile(int $userId, array $data): UserProfile;
    public function getProfileByUserId(int $userId): ?UserProfile;
}