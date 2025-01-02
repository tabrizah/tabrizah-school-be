<?php
namespace App\Services;

use App\Interfaces\Services\SystemLogServiceInterface;
use App\Interfaces\Repositories\SystemLogRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class SystemLogService implements SystemLogServiceInterface
{
    public function __construct(protected SystemLogRepositoryInterface $repository) {}

    public function logActivity(
        int $userId = null,
        string $type, 
        string $action, 
        string $entityType, 
        ?int $entityId = null, 
        ?string $description = null,
        ?array $additionalMetadata = []
    ) {
        $metadata = array_merge([
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'url' => request()->fullUrl(),
            'method' => request()->method(),
            'timestamp' => now()->toIso8601String()
        ], $additionalMetadata);

        // dd($metadata);

        return $this->repository->create([
            'user_id' => $userId,
            'type' => $type,
            'action' => $action,
            'entity_type' => $entityType,
            'entity_id' => $entityId,
            'description' => $description,
            'metadata' => $metadata,
            'status' => 'success'
        ]);
    }

    public function getLogs(array $filters = [], int $perPage = 15)
    {
        return $this->repository->getPaginatedLogs($filters, $perPage);
    }

    public function findById(int $id)
    {
        return $this->repository->findById($id);
    }
}