<?php 
namespace App\Models;

class Order implements \JsonSerializable {
    private ?int $id;
    private ?int $user_id;
    private ?string $order_date;
    private ?string $user_email;
    private ?User $user;
    private ?array $tickets = [];
    private ?string $payment_status;

    // Add ticket to the tickets array
    public function addTicket($ticket): void
    {
        $this->tickets[] = $ticket;
    }

    // Getters
    public function getId(): int
    {
        return $this->id;
    }

    public function getPaymentStatus(): ?string
    {
        return $this->payment_status;
    }

    public function getUserId(): ?int
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

    public function getTickets(): ?array
    {
        return $this->tickets;
    }

    public function getUserEmail(): ?string
    {
        return $this->user_email;
    }

    // Setters
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setPaymentStatus(?string $payment_status): void
    {
        $this->payment_status = $payment_status;
    }

    public function setUserEmail(?string $user_email): void
    {
        $this->user_email = $user_email;
    }

    public function setUserId(?int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function setOrderDate(string $order_date): void
    {
        $this->order_date = $order_date;
    }

    public function setUser($user): void
    {
        $this->user = $user;
    }

    public function setTickets(?array $tickets): void
    {
        $this->tickets = $tickets;
    }

    // JSON Serialize method
    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id ?? '', // if null, return empty string
            'user_id' => $this->user_id ?? '', // if null, return empty string
            'order_date' => $this->order_date ?? '', // if null, return empty string
            'user_email' => $this->user_email ?? '', // if null, return empty string
            'user' => $this->user ?? '', // if null, return empty string (you can adjust this based on your actual structure)
            'tickets' => $this->tickets ?? [], // if null, return empty array
            'payment_status' => $this->payment_status ?? '', // if null, return empty string
        ];
    }
    
}
