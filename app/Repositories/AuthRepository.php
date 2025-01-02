<?php

namespace App\Repositories;

use App\Interfaces\Repositories\AuthRepositoryInterface;
use App\Models\User;
use Carbon\Carbon;

class AuthRepository implements AuthRepositoryInterface
{
    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function createToken(User $user, string $deviceName = null): string
    {
        return $user->createToken(
            $deviceName ?? 'default_device',
            ['*'],
            now()->addDays(7)
        )->plainTextToken;
    }

    public function revokeTokens(User $user): void
    {
        $user->tokens()->delete();
    }

    public function updateLastLogin(User $user): void
    {
        $user->forceFill([
            'last_login_at' => Carbon::now(),
        ])->save();
    }
}