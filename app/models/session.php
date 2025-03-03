<?php
namespace App\Models;

class Session
{
    public int $id;
    public int $detail_event_id;
    public string $name;
    public ?string $description;
    public ?string $location;
    public int $ticket_limit;
    public int $duration_minutes;
    public float $price;
    public string $datetime_start; 


}
