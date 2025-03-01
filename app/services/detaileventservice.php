<?php
namespace App\Services;

use App\Repositories\DetailEventRepository;
use App\Models\DetailEvent;

class DetailEventService
{

    public function getById(int $id): ?DetailEvent
    {
        $repository = new \App\Repositories\DetailEventRepository();
        return $repository->getById($id);
    }

    /**
     * @return DetailEvent[]
     */
    public function getAll(): array
    {
        $repository = new \App\Repositories\DetailEventRepository();
        return $repository->getAll();
    }
}
