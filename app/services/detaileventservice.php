<?php
namespace App\Services;

use App\Repositories\DetailEventRepository;
use App\Models\DetailEvent;

class DetailEventService
{
    private DetailEventRepository $detailEventRepository;

    public function __construct(DetailEventRepository $detailEventRepository)
    {
        $this->detailEventRepository = $detailEventRepository;
    }

    public function getById(int $id): ?DetailEvent
    {
        return $this->detailEventRepository->getById($id);
    }

    /**
     * @return DetailEvent[]
     */
    public function getAll(): array
    {
        return $this->detailEventRepository->getAll();
    }
}
