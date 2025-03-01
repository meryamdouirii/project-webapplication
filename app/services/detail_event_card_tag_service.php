<?php
namespace App\Services;

use App\Repositories\DetailEventCardTagRepository;
use App\Models\DetailEventCardTag;

class DetailEventCardTagService
{
    private DetailEventCardTagRepository $repository;

    public function __construct(DetailEventCardTagRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getById(int $id): ?DetailEventCardTag
    {
        return $this->repository->getById($id);
    }

    /**
     * @return DetailEventCardTag[]
     */
    public function getAll(): array
    {
        return $this->repository->getAll();
    }
}
