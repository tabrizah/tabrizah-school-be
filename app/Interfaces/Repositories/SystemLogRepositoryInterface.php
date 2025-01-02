<?php
namespace App\Interfaces\Repositories;

interface SystemLogRepositoryInterface
{
    public function create(array $data);
    public function findById(int $id);
    public function getPaginatedLogs(array $filters = [], int $perPage = 15);
}