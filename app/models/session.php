<?php
namespace App\Models;

class Session
{
    private int $id;
    private int $detail_event_id;
    private string $name;  // ✅ Session name (e.g., "back2back", "club")
    private ?string $detailEventName; // ✅ Name from `detail_event` (e.g., "Hardwell", "Tiesto")
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
        ?string $detailEventName, // ✅ Fetch `detail_event.name`
        ?string $description,
        ?string $location,
        int $ticket_limit,
        int $duration_minutes,
        float $price,
        string $datetime_start
    ) {
        $this->id = $id;
        $this->detail_event_id = $detail_event_id;
        $this->name = $name; // ✅ Store session name
        $this->detailEventName = $detailEventName; // ✅ Store event name from `detail_event`
        $this->description = $description;
        $this->location = $location;
        $this->ticket_limit = $ticket_limit;
        $this->duration_minutes = $duration_minutes;
        $this->price = $price;
        $this->datetime_start = $datetime_start;
    }

    // ✅ Get session name (e.g., "back2back", "club")
    public function getName(): string
    {
        return $this->name;
    }

    // ✅ Get event name from `detail_event` (e.g., "Hardwell", "Tiesto")
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
