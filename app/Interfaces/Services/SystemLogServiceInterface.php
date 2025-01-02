<?php
namespace App\Interfaces\Services;

interface SystemLogServiceInterface
{
    public function logActivity(int $userId = null, string $type, string $action, string $entityType, ?int $entityId = null, ?string $description = null);
    public function getLogs(array $filters = [], int $perPage = 15);
    public function findById(int $id);
}