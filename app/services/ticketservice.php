<?php
namespace App\Services;

use App\Repositories\TicketRepository;
use App\Models\Ticket;

class TicketService
{

    function getAll(): array
    {
        $repository = new TicketRepository();
        return $repository->getAll();
    }
    function getById(int $id): ?Ticket
    {
        $repository = new TicketRepository();
        return $repository->getById($id);
    }
    function getByOrderId(int $orderId): array
    {
        $repository = new TicketRepository();
        return $repository->getByOrderId($orderId);
    }
    function insert(Ticket $ticket): bool
    {
        $repository = new TicketRepository();
        return $repository->insert($ticket);
    }

}
