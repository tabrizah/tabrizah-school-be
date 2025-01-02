<?php

namespace App\Interfaces\Repositories;

use App\Models\UserProfile;

interface UserProfileRepositoryInterface
{
    public function create(array $data): UserProfile;
    public function update(UserProfile $profile, array $data): UserProfile;
    public function findByUserId(int $userId): ?UserProfile;
    public function findById(int $id): ?UserProfile;
}