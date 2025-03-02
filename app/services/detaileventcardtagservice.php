<?php
namespace App\Services;

use App\Models\DetailEventCardTag;

class DetailEventCardTagService
{

    public function getById(int $id): ?DetailEventCardTag
    {
        $repository = new \App\Repositories\DetailEventCardTagRepository();
        return $repository->getById($id);
    }

    /**
     * @return DetailEventCardTag[]
     */
    public function getAll(): array
    {
        $repository = new \App\Repositories\DetailEventCardTagRepository();
        return $repository->getAll();
    }

    /**
     * @return string[]
     */
    public function getTagsByDetailEventId(int $detailEventId): array
    {
        $repository = new \App\Repositories\DetailEventCardTagRepository();
        return $repository->getTagsByDetailEventId($detailEventId);
    }
}
