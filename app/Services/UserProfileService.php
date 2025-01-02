<?php

namespace App\Services;

use App\Interfaces\Repositories\UserProfileRepositoryInterface;
use App\Interfaces\Services\UserProfileServiceInterface;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserProfileService implements UserProfileServiceInterface
{
    protected $userProfileRepository;

    public function __construct(UserProfileRepositoryInterface $userProfileRepository)
    {
        $this->userProfileRepository = $userProfileRepository;
    }

    public function createProfile(array $data): UserProfile
    {
        $data['photo'] = $this->handlePhotoUpload(
            $data['photo'] ?? null,
            $data['full_name'] ?? null
        );

        return $this->userProfileRepository->create($data);
    }

    public function updateProfile(int $userId, array $data): UserProfile
    {
        $profile = $this->userProfileRepository->findByUserId($userId);

        if (!$profile) {
            throw new ModelNotFoundException('Profile not found');
        }

        if (isset($data['photo'])) {
            // Delete old photo if it's a storage file
            if ($profile->photo && Storage::exists($profile->photo)) {
                Storage::delete($profile->photo);
            }
            
            $data['photo'] = $this->handlePhotoUpload(
                $data['photo'],
                $data['full_name'] ?? $profile->full_name
            );
        }

        return $this->userProfileRepository->update($profile, $data);
    }

    public function getProfileByUserId(int $userId): ?UserProfile
    {
        return $this->userProfileRepository->findByUserId($userId);
    }

    protected function handlePhotoUpload($photo = null, string $name = null): string
    {
        if ($photo) {
            return Storage::putFile('profile-photos', $photo);
        }
        
        // Generate avatar URL using UI Avatars API
        $encodedName = urlencode($name ?? 'User');
        return "https://ui-avatars.com/api/?name={$encodedName}&background=random";
    }
}