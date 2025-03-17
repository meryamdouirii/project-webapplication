<?php
namespace App\Repositories;
use App\Models\Ticket;
use App\Models\Order;
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

    public function getOrdersByUser($userId): array
    {
        try {
            // ✅ 1. Fetch all orders placed by the user
            $sql = "SELECT * FROM ticket_order WHERE user_id = :user_id ORDER BY order_date DESC";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([':user_id' => $userId]);
            $ordersData = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $orders = [];

            foreach ($ordersData as $orderData) {
                // ✅ 2. Fetch tickets with event, session, and artist/restaurant name
                $ticketSql = "SELECT t.*, 
                                 s.name AS session_name, 
                                 s.location, 
                                 s.datetime_start, 
                                 s.price AS ticket_price, 
                                 e.name AS event_name,
                                 de.name AS artist_or_restaurant_name, -- ✅ Fetch artist/restaurant name
                                 de.card_image AS event_image
                          FROM ticket t
                          JOIN session s ON t.session_id = s.id
                          JOIN detail_event de ON s.detail_event_id = de.id
                          JOIN event e ON de.event_id = e.id
                          WHERE t.order_id = :order_id";
                $ticketStmt = $this->connection->prepare($ticketSql);
                $ticketStmt->execute([':order_id' => $orderData['id']]);
                $ticketData = $ticketStmt->fetchAll(PDO::FETCH_ASSOC);

                // ✅ 3. Convert ticket data into Ticket objects
                $tickets = [];
                foreach ($ticketData as $ticket) {
                    $tickets[] = new Ticket(
                        id: $ticket['id'],
                        order_id: $ticket['order_id'],
                        session_id: $ticket['session_id'],
                        user_id: $ticket['user_id'],
                        bar_code: $ticket['bar_code'],
                        session: [
                            'session_name' => $ticket['session_name'],
                            'location' => $ticket['location'],
                            'datetime_start' => $ticket['datetime_start'],
                            'ticket_price' => $ticket['ticket_price'],
                            'event_name' => $ticket['event_name'],
                            'artist_or_restaurant_name' => $ticket['artist_or_restaurant_name'], // ✅ Add artist/restaurant
                            'event_image' => $ticket['event_image']
                        ]
                    );
                }

                // ✅ 4. Convert order data into an Order object with Ticket objects
                $orders[] = new Order(
                    id: $orderData['id'],
                    user_id: $orderData['user_id'],
                    order_date: $orderData['order_date'],
                    user: $_SESSION['user'],
                    tickets: $tickets
                );
            }

            return $orders;
        } catch (PDOException $e) {
            die("Database error: " . $e->getMessage());
        }
    }







}
?>