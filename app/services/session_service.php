<?php
namespace App\Services;

use App\Repositories\SessionRepository;
use App\Models\Session;

class SessionService
{
    private SessionRepository $sessionRepository;

    public function __construct(SessionRepository $sessionRepository)
    {
        $this->sessionRepository = $sessionRepository;
    }

    public function getById(int $id): ?Session
    {
        return $this->sessionRepository->getById($id);
    }

    /**
     * @return Session[]
     */
    public function getAll(): array
    {
        return $this->sessionRepository->getAll();
    }
}
