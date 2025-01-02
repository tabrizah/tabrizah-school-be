<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SystemLogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'action' => $this->action,
            'entity_type' => $this->entity_type,
            'entity_id' => $this->entity_id,
            'description' => $this->description,
            'status' => $this->status,
            'metadata' => [
                'ip' => $this->metadata['ip'] ?? null,
                'user_agent' => $this->metadata['user_agent'] ?? null,
                'url' => $this->metadata['url'] ?? null,
                'method' => $this->metadata['method'] ?? null,
                'timestamp' => $this->metadata['timestamp'] ?? null,
            ],
            'created_at' => $this->created_at->toISOString(),
            'user' => [
                'id' => $this->user?->id,
                'name' => $this->user?->name,
            ],
        ];
    }
}
