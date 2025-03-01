<?php
namespace App\Models;

class DetailEventCardTag
{
    private int $id;
    private int $detail_event_id;
    private ?string $tag;

    public function __construct(int $id, int $detail_event_id, ?string $tag)
    {
        $this->id = $id;
        $this->detail_event_id = $detail_event_id;
        $this->tag = $tag;
    }

    // Getters
    public function getId(): int
    {
        return $this->id;
    }

    public function getDetailEventId(): int
    {
        return $this->detail_event_id;
    }

    public function getTag(): ?string
    {
        return $this->tag;
    }
}
