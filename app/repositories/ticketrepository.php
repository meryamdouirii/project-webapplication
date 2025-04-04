<?php
namespace App\Repositories;
use App\Models\Ticket;
use App\Models\Session;
use App\Repositories\SessionRepository;
use PDO;

class TicketRepository extends Repository {

    private SessionRepository $sessionRepository;
    public function __construct() {
        parent::__construct();
        $this->sessionRepository = new SessionRepository();
    }
    public function getAll() : array {
        $stmt = $this->connection->prepare("SELECT id, order_id, session_id, bar_code FROM ticket");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC); // Fetch as associative array
        $ticketsData = $stmt->fetchAll();

        $tickets = [];
        // Manually instantiate Ticket objects
        foreach ($ticketsData as $ticketData) {
            $ticket = new Ticket(
                $ticketData['id'],
                $ticketData['order_id'],
                $ticketData['session_id'],
                $ticketData['bar_code'],
                null // session will be fetched separately
            );
            $ticket->setSession($this->sessionRepository->getById($ticket->getSessionId()));
            $tickets[] = $ticket;
        }

        return $tickets;
    }

    // Get a ticket by its ID with session details
    public function getById($id) : ?Ticket {
        $stmt = $this->connection->prepare("SELECT id, order_id, session_id, bar_code FROM ticket WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC); // Fetch as associative array
        $ticketData = $stmt->fetch();

        if ($ticketData) {
            $ticket = new Ticket(
                $ticketData['id'],
                $ticketData['order_id'],
                $ticketData['session_id'],
                $ticketData['bar_code'],
                null // session will be fetched separately
            );
            $ticket->setSession($this->sessionRepository->getById($ticket->getSessionId()));
            return $ticket;
        }

        return null; // Return null if no ticket found
    }
    public function getByOrderId(int $orderId): array {
        $stmt = $this->connection->prepare("SELECT id, order_id, session_id, bar_code FROM ticket WHERE order_id = :order_id");
        $stmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $ticketsData = $stmt->fetchAll();
    
        $tickets = [];
        foreach ($ticketsData as $ticketData) {
            $ticket = new Ticket(
                $ticketData['id'],
                $ticketData['order_id'],
                $ticketData['session_id'],
                $ticketData['bar_code'],
                null
            );
            $ticket->setSession($this->sessionRepository->getById($ticket->getSessionId()));
            $tickets[] = $ticket;
        }
    
        return $tickets;
    }
    
    // Insert a new ticket into the database
    public function insert(Ticket $ticket) : bool {
        try {
            $stmt = $this->connection->prepare("
                INSERT INTO ticket (order_id, session_id, bar_code) 
                VALUES (:order_id, :session_id, :bar_code)
            ");

            return $stmt->execute([
                ':order_id' => $ticket->getOrderId(),
                ':session_id' => $ticket->getSessionId(),
                ':bar_code' => $ticket->getBarCode()
            ]);
        } catch (\Exception $e) {
            // Log the exception or handle it appropriately
            return false;
        }
    }

}
?>