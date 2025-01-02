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
                'permissions' => $this->resource['user']->getAllPermissions()->pluck('name'),
                'roles' => $this->resource['user']->getRoleNames(),
            ],
            'token' => $this->resource['token'],
            'token_type' => 'Bearer',
        ];
    }
}