<?php
namespace App\Traits;

use App\Services\SystemLogService;

trait Loggable
{
    protected function log(
        ?string $userId,
        string $type,
        string $action,
        string $entityType,
        ?int $entityId = null,
        ?string $description = null,
        array $additionalMetadata = []
    ): void {
        app(SystemLogService::class)->logActivity(
            userId: $userId,
            type: $type,
            action: $action,
            entityType: $entityType,
            entityId: $entityId,
            description: $description,
            additionalMetadata: $additionalMetadata
        );
    }
}