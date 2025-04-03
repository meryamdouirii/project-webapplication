<?php
namespace App\Models;

class Ticket
{
    private int $id;

    private int $order_id;

    private int $session_id;

    private string $bar_code;

    private $session;


    public function __construct(int $id, int $order_id, int $session_id, string $bar_code, $session)
    {
        $this->id = $id;
        $this->order_id = $order_id;
        $this->session_id = $session_id;
        $this->bar_code = $bar_code;
        $this->session = $session;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getOrderId(): int
    {
        return $this->order_id;
    }

    public function getSessionId(): int
    {
        return $this->session_id;
    }

    public function getbarCode(): string
    {
        return $this->bar_code;
    }

    public function getSession()
    {
        return $this->session;
    }
   





}
