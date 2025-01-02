<?php

namespace App\Services;

use App\Events\EventUserAuthenticated;
use App\Interfaces\Repositories\AuthRepositoryInterface;
use App\Interfaces\Services\AuthServiceInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService implements AuthServiceInterface
{
    protected $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function attemptLogin(string $email, string $password): array
    {
        $user = $this->authRepository->findByEmail($email);

        if (!$user || !Hash::check($password, $user->password)) {
            return ['success' => false];
        }

        $token = $this->authRepository->createToken($user);

        // Dispatch authentication event
        event(new EventUserAuthenticated($user, $token, [
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent()
        ]));

        return [
            'success' => true,
            'user' => $user,
            'token' => $token
        ];
    }

    public function register(array $dataRegister): array
    {
        $registerUser = $this->authRepository->createUser($dataRegister);

        return [
            'user' => $registerUser,
            'token' => $this->authRepository->createToken($registerUser)
        ];
    }

    public function logout(User $user): void
    {
        $this->authRepository->revokeTokens($user);
    }

    public function refreshToken(User $user): array
    {
        $this->authRepository->revokeTokens($user);
        $token = $this->authRepository->createToken($user);

        return [
            'user' => $user,
            'token' => $token
        ];
    }
}