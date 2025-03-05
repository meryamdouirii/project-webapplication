<?php
namespace App\Models;

class Songs
{
    private int $id;

    private int $detail_event_id;

    private string $detailEventName;

    private string $photo;

    private string $title;

    private string $description;

    public function __construct(int $id, int $detail_event_id, string $detailEventName, string $photo, string $title, string $description)
    {
        $this->id = $id;
        $this->detail_event_id = $detail_event_id;
        $this->detailEventName = $detailEventName;
        $this->photo = $photo;
        $this->title = $title;
        $this->description = $description;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getDetailEventId(): int
    {
        return $this->detail_event_id;
    }

    public function setDetailEventId(int $detail_event_id): void
    {
        $this->detail_event_id = $detail_event_id;
    }

    public function getDetailEventName(): string
    {
        return $this->detailEventName;
    }

    public function setDetailEventName(string $detailEventName): void
    {
        $this->detailEventName = $detailEventName;
    }

    public function getPhoto(): string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): void
    {
        $this->photo = $photo;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }






}
