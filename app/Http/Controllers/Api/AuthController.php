<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Auth\AuthResource;
use App\Interfaces\Services\AuthServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Interfaces\Services\UserProfileServiceInterface;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\UserProfileResource;

class AuthController extends Controller
{
    protected $authService;

    protected $userProfileService;

    public function __construct(
        AuthServiceInterface $authService,
        UserProfileServiceInterface $userProfileService
        )
    {
        $this->authService = $authService;
        $this->userProfileService = $userProfileService;
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->validated();
        
        $result = $this->authService->attemptLogin(
            $credentials['email'],
            $credentials['password']
        );

        if (!$result['success']) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        return response()->json([
            'message' => 'Login successful',
            'data' => new AuthResource($result)
        ]);
    }

    public function register(RegisterRequest $request)
    {
        
        DB::beginTransaction();
        try {
            $validatedData = $request->validated();
            
            // Register user and create profile
            $result = $this->authService->register($validatedData);
            

            // Create user profile
            $this->userProfileService->createProfile([
                'user_id' => $result['user']->id,
                'nik' => $validatedData['nik'],
                'full_name' => $validatedData['full_name'],
                'birth_date' => $validatedData['birth_date'],
                'birth_place' => $validatedData['birth_place'],
                'address' => $validatedData['address'],
                'phone' => $validatedData['phone'] ?? null,
                'emergency_contact' => $validatedData['emergency_contact'],
                'photo' => $validatedData['photo'] ?? null,
                'active' => true
            ]);

            DB::commit();

            // event(new \App\Events\EventUserAuthenticated(
            //     $result['user'], 
            //     $result['token'],
            //     [
            //         'ip' => $request->ip(),
            //         'user_agent' => $request->userAgent()
            //     ]
            // ));

            return response()->json([
                'message' => 'Registration successful',
                'data' => new AuthResource($result)
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            

            return response()->json([
                'message' => 'Registration failed',
                'error' => config('app.debug') ? $e->getMessage() : 'An error occurred during registration',
                'trace' => $e->getTraceAsString()
            ], 422);
        }
    }
    

    public function logout(Request $request): JsonResponse
    {
        $this->authService->logout($request->user());

        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }

    public function refresh(Request $request): JsonResponse
    {
        $result = $this->authService->refreshToken($request->user());

        return response()->json([
            'message' => 'Token refreshed',
            'dataLogin' => new AuthResource($result),
            'dataProfile' => new UserProfileResource($result)
        ]);
    }
}