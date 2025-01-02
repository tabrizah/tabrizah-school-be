<?php

namespace App\Interfaces\Repositories;

use App\Models\User;

interface AuthRepositoryInterface
{
    public function findByEmail(string $email): ?User;
    public function createToken(User $user, string $deviceName = null): string;
    public function revokeTokens(User $user): void;
    public function updateLastLogin(User $user): void;
}