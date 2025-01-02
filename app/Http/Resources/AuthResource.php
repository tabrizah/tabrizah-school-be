<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'user' => [
                'id' => $this->resource['user']->id,
                'email' => $this->resource['user']->email,
                'profile' => [
                    'full_name' => $this->resource['user']->profile->full_name ?? null,
                    'photo' => $this->resource['user']->profile->photo ?? null,
                ],
                'roles' => $this->resource['user']->roles->pluck('name'),
                'permissions' => $this->resource['user']->permissions->pluck('name'),
            ],
            'token' => $this->resource['token'],
            'token_type' => 'Bearer',
        ];
    }
}
