<?php
namespace App\Repositories;
use App\Models\Ticket;
use App\Models\Order;
use App\Models\User;
use App\Models\Enums\UserType;
use App\Models\Session;

use PDO;
use PDOException;

class OrderRepository extends Repository
{
    public function getAll()
    {

    }

    public function getById($id)
    {

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

    public function getOrderData(int $orderId): ?array
    {
        try {
            // 1. Get Order with User
            $order = $this->getOrderWithUser($orderId);
            if (!$order)
                return null;

            // 2. Get Tickets with full hierarchy
            $tickets = $this->getTicketsForOrder($orderId);
            $order = new Order(
                $order->getId(),
                $order->getUserId(),
                $order->getOrderDate(),
                $order->getUser(),
                $tickets // Pass tickets through constructor
            );

            // 3. Get Payment info
            $payment = $this->getPaymentForOrder($orderId);

            return [
                'order' => $order,
                'payment' => $payment
            ];

        } catch (PDOException $e) {
            error_log("Order retrieval error: " . $e->getMessage());
            return null;
        }
    }

    private function getOrderWithUser(int $orderId): ?Order
    {
        $stmt = $this->connection->prepare("
        SELECT to.*, u.* 
        FROM ticket_order to
        JOIN user u ON to.user_id = u.id
        WHERE to.id = :order_id
    ");
        $stmt->execute([':order_id' => $orderId]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data)
            return null;

        return new Order(
            (int) $data['id'],
            (int) $data['user_id'],
            $data['order_date'],
            $this->createUserFromData($data),
            [] // Tickets loaded separately
        );
    }

    private function getTicketsForOrder(int $orderId): array
    {
        $stmt = $this->connection->prepare("
        SELECT t.*, s.*, de.*, e.*
        FROM ticket t
        JOIN session s ON t.session_id = s.id
        JOIN detail_event de ON s.detail_event_id = de.id
        JOIN event e ON de.event_id = e.id
        WHERE t.order_id = :order_id
    ");
        $stmt->execute([':order_id' => $orderId]);

        $tickets = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $tickets[] = new Ticket(
                (int) $row['id'],
                (int) $row['order_id'],
                (int) $row['session_id'],
                (int) $row['user_id'],
                (string) $row['bar_code'],
                $this->createSessionFromData($row)
            );
        }
        return $tickets;
    }

    private function getPaymentForOrder(int $orderId): ?array
    {
        $stmt = $this->connection->prepare("
        SELECT payment_status, amount, created_at
        FROM payment
        WHERE order_id = :order_id
    ");
        $stmt->execute([':order_id' => $orderId]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    private function createUserFromData(array $data): User
    {
        return new User(
            (int) $data['user_id'],
            UserType::from($data['type']),
            $data['first_name'],
            $data['last_name'],
            $data['phone_number'],
            $data['email_address'],
            '', // password_hash excluded
            '', // salt excluded
            null, // reset_token_hash
            null  // reset_token_expires_at
        );
    }

    private function createSessionFromData(array $data): Session
    {
        return new Session(
            (int) $data['id'],
            (int) $data['detail_event_id'],
            $data['name'],
            $data['name'], // detailEventName
            $data['description'],
            $data['location'],
            (int) $data['ticket_limit'],
            (int) $data['duration_minutes'],
            (float) $data['price'],
            $data['datetime_start'],
            (int) $data['sold_tickets']
        );
    }













}
?>