<?php 
namespace App\Models;
class Order{
    private int $id;
    private int $user_id;
    private string $order_date;

    private $user;

    private ?array $tickets = [];

    public function __construct(int $id, int $user_id, string $order_date, $user, ?array $tickets = [])
    {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->order_date = $order_date;
        $this->user = $user;
        $this->tickets = $tickets;
    } 

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getOrderDate(): string
    {
        return $this->order_date;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getTickets(): array
    {
        return $this->tickets;
    }

}