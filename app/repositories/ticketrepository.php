<?php
namespace App\Repositories;
use App\Models\Ticket;
use PDO;

class HomepageRepository extends Repository {

    public function getAll() {
        $stmt = $this->connection->prepare("SELECT id, order_id, session_id, bar_code FROM ticket");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, '\\App\\Models\\Ticket');
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->connection->prepare("SELECT id, order_id, session_id, bar_code FROM ticket WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, '\\App\\Models\\Ticket');
        return $stmt->fetch();
    }
    
    public function insert(Ticket $ticket){
        $stmt = $this->connection->prepare("
            INSERT INTO ticket (order_id, session_id, bar_code) 
            VALUES (:order_id, :session_id, :bar_code)
        ");

        return $stmt->execute([
            ':order_id' => $ticket->getOrderId(),
            ':session_id' => $ticket->getSessionId(),
            ':bar_code' => $ticket->getBarCode()
        ]);
    }
}
?>