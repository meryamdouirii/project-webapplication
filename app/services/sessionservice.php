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
    public function getSessionsByEventId(int $eventId): array
    {
        $repository = new SessionRepository();
        return $repository->getSessionsByEventId($eventId);
    }
    public function getSessionsByDetailEventId(int $eventId): array
    {
        $repository = new SessionRepository();
        return $repository->getSessionsByDetailEventId($eventId);
    }

    public function getByEventId(int $eventId): ?Session
    {
        $repository = new SessionRepository();
        return $repository->getByEventId($eventId);
    }

    public function getSessionsGroupedByDateAndEventId(int $eventId): array
    {
        $sessions = $this->getSessionsByEventId($eventId); //dance event
        $groupedSessions = [];

        foreach ($sessions as $session) {
            $date = $session->getDate();
            $groupedSessions[$date][] = $session;
        }

        return $groupedSessions;
    }
}
