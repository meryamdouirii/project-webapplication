<?php
namespace App\Services;

use App\Repositories\SessionRepository;
use App\Models\Session;

class SessionService
{

    public function getById(int $id): ?Session
    {
        $repository = new SessionRepository();
        return $repository->getById($id);
    }

    /**
     * @return Session[]
     */
    public function getAll(): array
    {
        $repository = new SessionRepository();
        return $repository->getAll();
    }

    public function getByEventId(int $eventId): ?Session
    {
        $repository = new SessionRepository();
        return $repository->getByEventId($eventId);
    }
}
