<?php
namespace App\Repositories;
use App\Models\Ticket;
use App\Models\Oeder;
use PDO;
use PDOException;

class OrderRepository extends Repository
{
    public function getAll() {

    }

    public function getById($id) {

    }


    public function placeOrder($order)
    {
        try {
            $this->connection->beginTransaction(); 

            $sql = "INSERT INTO ticket_order (user_id) VALUES (:user_id)";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([
                ':user_id' => $_SESSION['user']['id']
            ]);

            $orderId = $this->connection->lastInsertId();

            $ticketSql = "INSERT INTO ticket (order_id, session_id, bar_code, user_id) VALUES (:order_id, :session_id, :bar_code, :user_id)";
            $ticketStmt = $this->connection->prepare($ticketSql);

            foreach ($order as $ticket) {
                $quantity = intval($ticket['quantity']); 
    
                for ($i = 0; $i < $quantity; $i++) { // Voeg meerdere tickets in als quantity > 1
                    $ticketStmt->execute([
                        ':order_id' => $orderId,
                        ':session_id' => $ticket['session_id'], 
                        ':bar_code' => rand(10000, 99999), // Unieke barcode per ticket
                        ':user_id' => $_SESSION['user']['id']
                    ]);
                }
            }

            $this->connection->commit(); // Commit the transaction
            return $orderId;
        } catch (PDOException $e) {
            $this->connection->rollBack(); // Rollback in case of error
            die("Database error: " . $e->getMessage());
        }
    }

    

}
?>