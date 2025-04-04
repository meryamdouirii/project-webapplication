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
    public function getAll(): array
    {
        try {
            // SQL query to fetch all orders with payment status and ticket details
            $sql = "SELECT 
                        ticket_order.*, 
                        payment.payment_status, 
                        t.id AS ticket_id,
                        s.name AS session_name,
                        s.datetime_start,
                        s.price AS ticket_price,
                        u.email_address 
                    FROM ticket_order
                    LEFT JOIN payment ON ticket_order.id = payment.order_id
                    LEFT JOIN ticket t ON ticket_order.id = t.order_id
                    LEFT JOIN session s ON t.session_id = s.id
                    LEFT JOIN detail_event de ON s.detail_event_id = de.id
                    LEFT JOIN event e ON de.event_id = e.id
                    LEFT JOIN user u ON ticket_order.user_id = u.id  
                    ORDER BY ticket_order.order_date DESC
                ";

            $stmt = $this->connection->prepare($sql);
            $stmt->execute();

            $ordersData = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $orders = [];
            $currentOrderId = null;
            $currentOrderData = null; // Initialize this as null

            foreach ($ordersData as $row) {
                // Check if it's a new order based on the order id
                if ($currentOrderId !== $row['id']) {
                    // If it's a new order and we have an existing order, add it to the orders array
                    if ($currentOrderData !== null) {
                        $orders[] = $currentOrderData;
                    }

                    // Start a new order
                    $currentOrderId = $row['id'];
                    $currentOrderData = new Order();
                    $currentOrderData->setId($row['id']);
                    $currentOrderData->setUserEmail($row['email_address']);
                    $currentOrderData->setOrderDate($row['order_date']);
                    $currentOrderData->setPaymentStatus($row['payment_status']);
                    $currentOrderData->setTickets([]); // Initialize tickets as an empty array
                }

                // Add ticket details to the current order
                $currentOrderData->addTicket([
                    'ticket_id' => $row['ticket_id'],
                    'session_name' => $row['session_name'],
                    'datetime_start' => $row['datetime_start'],
                    'ticket_price' => $row['ticket_price']
                ]);
            }

            // Add the last order to the list after the loop ends
            if ($currentOrderData !== null) {
                $orders[] = $currentOrderData;
            }

            return $orders;
        } catch (PDOException $e) {
            die("Database error: " . $e->getMessage());
        }
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
            // Fetch all orders placed by the user
            $sql = "SELECT ticket_order.*
        FROM ticket_order
        INNER JOIN payment ON ticket_order.id = payment.order_id
        WHERE ticket_order.user_id = :user_id 
        AND payment.payment_status = 'paid'
        ORDER BY ticket_order.order_date DESC ";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([':user_id' => $userId]);
            $ordersData = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $orders = [];

            foreach ($ordersData as $orderData) {
                // Fetch tickets with event, session, and artist/restaurant name
                $ticketSql = "SELECT t.*, 
                             s.name AS session_name, 
                             s.location, 
                             s.datetime_start, 
                             s.price AS ticket_price,
                             s.detail_event_id,
                             s.ticket_limit,
                             s.duration_minutes, 
                             e.name AS event_name,
                             de.name AS artist_or_restaurant_name, 
                             de.card_image AS event_image
                      FROM ticket t
                      JOIN session s ON t.session_id = s.id
                      JOIN detail_event de ON s.detail_event_id = de.id
                      JOIN event e ON de.event_id = e.id
                      WHERE t.order_id = :order_id";
                $ticketStmt = $this->connection->prepare($ticketSql);
                $ticketStmt->execute([':order_id' => $orderData['id']]);
                $ticketData = $ticketStmt->fetchAll(PDO::FETCH_ASSOC);

                // Convert ticket data into Ticket objects
                $tickets = [];
                foreach ($ticketData as $ticket) {
                    // Create a proper Session object
                    $session = new Session(
                        $ticket['session_id'],
                        $ticket['detail_event_id'],
                        $ticket['session_name'],
                        $ticket['artist_or_restaurant_name'], // detailEventName
                        '', // description - not available or empty
                        $ticket['location'],
                        $ticket['ticket_limit'],
                        $ticket['duration_minutes'],
                        (float) $ticket['ticket_price'],
                        $ticket['datetime_start']
                    );

                    $tickets[] = new Ticket(
                        id: $ticket['id'],
                        order_id: $ticket['order_id'],
                        session_id: $ticket['session_id'],
                        bar_code: $ticket['bar_code'],
                        session: $session
                    );
                }
                $order = new Order();
                $order->setId($orderData['id']);
                $order->setUserId($orderData['user_id']);
                $order->setOrderDate($orderData['order_date']);
                $order->setUser($_SESSION['user']);
                $order->setTickets($tickets);

                $orders[] = $order;
            }

            return $orders;
        } catch (PDOException $e) {
            die("Database error: " . $e->getMessage());
        }
    }

    // public function getOrdersByUser($userId): array
    // {
    //     try {
    //         // Fetch all orders placed by the user
    //         $sql = "SELECT ticket_order.*
    //         FROM ticket_order
    //         INNER JOIN payment ON ticket_order.id = payment.order_id
    //         WHERE ticket_order.user_id = :user_id 
    //         AND payment.payment_status = 'paid'
    //         ORDER BY ticket_order.order_date DESC ";
    //         $stmt = $this->connection->prepare($sql);
    //         $stmt->execute([':user_id' => $userId]);
    //         $ordersData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //         $orders = [];

    //         foreach ($ordersData as $orderData) {
    //             // Fetch tickets with event, session, and artist/restaurant name
    //             $ticketSql = "SELECT t.*, 
    //                              s.name AS session_name, 
    //                              s.location, 
    //                              s.datetime_start, 
    //                              s.price AS ticket_price, 
    //                              e.name AS event_name,
    //                              de.name AS artist_or_restaurant_name, 
    //                              de.card_image AS event_image
    //                       FROM ticket t
    //                       JOIN session s ON t.session_id = s.id
    //                       JOIN detail_event de ON s.detail_event_id = de.id
    //                       JOIN event e ON de.event_id = e.id
    //                       WHERE t.order_id = :order_id";
    //             $ticketStmt = $this->connection->prepare($ticketSql);
    //             $ticketStmt->execute([':order_id' => $orderData['id']]);
    //             $ticketData = $ticketStmt->fetchAll(PDO::FETCH_ASSOC);

    //             // Convert ticket data into Ticket objects
    //             $tickets = [];
    //             foreach ($ticketData as $ticket) {
    //                 $tickets[] = new Ticket(
    //                     id: $ticket['id'],
    //                     order_id: $ticket['order_id'],
    //                     session_id: $ticket['session_id'],
    //                     bar_code: $ticket['bar_code'],
    //                     session: [
    //                         'session_name' => $ticket['session_name'],
    //                         'location' => $ticket['location'],
    //                         'datetime_start' => $ticket['datetime_start'],
    //                         'ticket_price' => $ticket['ticket_price'],
    //                         'event_name' => $ticket['event_name'],
    //                         'artist_or_restaurant_name' => $ticket['artist_or_restaurant_name'], 
    //                         'event_image' => $ticket['event_image']
    //                     ]
    //                 );
    //             }
    //             $order = new Order();
    //             $order->setId($orderData['id']);
    //             $order->setUserId($orderData['user_id']);
    //             $order->setOrderDate($orderData['order_date']);
    //             $order->setUser($_SESSION['user']);
    //             $order->setTickets($tickets);

    //             $orders[] = $order;
    //         }

    //         return $orders;
    //     } catch (PDOException $e) {
    //         die("Database error: " . $e->getMessage());
    //     }
    // }


    public function getOrderData(int $orderId): ?array
    {
        try {
            // 1. Get Order with User info
            $order = $this->getOrderWithUser($orderId);
            if (!$order)
                return null;

            //2. Get Tickets for the Order
            $tickets = $this->getTicketsForOrder($orderId);
            // $order = new Order(
            // );

            // $order->setId($order->getId());
            // $order->setUserId($order->getUserId());
            // $order->setOrderDate($order->getOrderDate());
            // $order->setUser($order->getUser());
            $order->setTickets($tickets);

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
            SELECT t_order.*, u.* 
            FROM ticket_order t_order
            JOIN user u ON t_order.user_id = u.id
            WHERE t_order.id = :order_id
        ");
        $stmt->execute([':order_id' => $orderId]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data)
            return null;

        $order = new Order();
        $order->setId($data['id']);
        $order->setUserId($data['user_id']);
        $order->setOrderDate($data['order_date']);
        $order->setUser($this->createUserFromData($data));
        $order->setTickets([]);
        return $order;
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