<?php
namespace App\Models;

class Session
{
    private int $id;
    private int $detail_event_id;
    private string $name;  
    private ?string $detailEventName; 
    private ?string $description;
    private ?string $location;
    private int $ticket_limit;
    private int $duration_minutes;
    private float $price;
    private string $datetime_start;


    public function __construct(
        int $id,
        int $detail_event_id,
        string $name, 
        ?string $detailEventName, 
        ?string $description,
        ?string $location,
        int $ticket_limit,
        int $duration_minutes,
        float $price,
        string $datetime_start
    ) {
        $this->id = $id;
        $this->detail_event_id = $detail_event_id;
        $this->name = $name; 
        $this->detailEventName = $detailEventName; 
        $this->description = $description;
        $this->location = $location;
        $this->ticket_limit = $ticket_limit;
        $this->duration_minutes = $duration_minutes;
        $this->price = $price;
        $this->datetime_start = $datetime_start;

    }
    
    public function getDetailEventId(): int { return $this->detail_event_id; }
    public function getDescription(): ?string { return $this->description; }
    public function getId(): int {
        return $this->id;
    }
    public function getTicketLimit(): int {
        return $this->ticket_limit;
    }

    public function getDurationMinutes(): int {
        return $this->duration_minutes;
    }

    public function getName(): string
    {
        return $this->name;
    }


    public function getDetailEventName(): string
    {
        return $this->detailEventName;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getDateTimeStart(): string
    {
        return $this->datetime_start;
    }

    public function getDate(): string
    {
        return date("d F", strtotime($this->datetime_start)); // Format: "25 July"
    }

    public function getStartTime(): string
    {
        return date("H:i", strtotime($this->datetime_start)); // Format: "23:00"
    }

    public function getEndTime(): string
    {
        return date("H:i", strtotime($this->datetime_start . " +{$this->duration_minutes} minutes")); // Calculate end time
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function getTicketsAvailable(): int
    {
        return $this->ticket_limit;
    }
}
