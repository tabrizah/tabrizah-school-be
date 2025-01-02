<?php

namespace App\Interfaces\Services;

use App\Models\User;

interface AuthServiceInterface
{
    public function attemptLogin(string $email, string $password): array;
    public function logout(User $user): void;
    public function refreshToken(User $user): array;
}