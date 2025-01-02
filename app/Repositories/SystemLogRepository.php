<?php
namespace App\Repositories;

use App\Models\SystemLog;
use App\Interfaces\Repositories\SystemLogRepositoryInterface;

class SystemLogRepository implements SystemLogRepositoryInterface
{
    public function __construct(protected SystemLog $model) {}

    public function create(array $data)
    {
        if (isset($data['metadata']) && is_array($data['metadata'])) {
            $data['metadata'] = json_encode($data['metadata']);
        }
        return $this->model->create($data);
    }

    public function findById(int $id)
    {
        return $this->model->findOrFail($id);
    }

    public function getPaginatedLogs(array $filters = [], int $perPage = 15)
    {
        $query = $this->model->query();
        
        // Add basic filters
        if (isset($filters['type'])) {
            $query->where('type', $filters['type']);
        }
        
        if (isset($filters['date_range'])) {
            $query->whereBetween('created_at', $filters['date_range']);
        }

        if (isset($filters['user_id'])) {
            $query->where('user_id', $filters['user_id']);
        }


        return $query->latest()->paginate($perPage);
    }
}