<?php
namespace App\Models;

class DetailEvent
{

    private int $id;
    private int $event_id;
    private ?string $banner_description;
    private ?string $banner_image;
    private string $name;
    private ?string $description;
    private ?string $image_description_1;
    private ?string $image_description_2;
    private ?string $card_image;
    private ?string $card_description;
    private ?int $amount_of_stars;
    private ?array $tags;

    public function __construct(
        int $id,
        int $event_id,
        ?string $banner_description,
        ?string $banner_image,
        string $name,
        ?string $description,
        ?string $image_description_1,
        ?string $image_description_2,
        ?string $card_image,
        ?string $card_description,
        ?int $amount_of_stars,
        ?array $tags
    ) {
        $this->id = $id;
        $this->event_id = $event_id;
        $this->banner_description = $banner_description;
        $this->banner_image = $banner_image;
        $this->name = $name;
        $this->description = $description;
        $this->image_description_1 = $image_description_1;
        $this->image_description_2 = $image_description_2;
        $this->card_image = $card_image;
        $this->card_description = $card_description;
        $this->amount_of_stars = $amount_of_stars;
        $this->tags = $tags;
    }

    // --- Getters and setters
    public function getId(): int
    {
        return $this->id;
    }

    public function getEventId(): int
    {
        return $this->event_id;
    }

    public function getBannerDescription(): ?string
    {
        return $this->banner_description;
    }

    public function getBannerImage(): ?string
    {
        return $this->banner_image;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getImageDescription1(): ?string
    {
        return $this->image_description_1;
    }

    public function getImageDescription2(): ?string
    {
        return $this->image_description_2;
    }

    public function getCardImage(): ?string
    {
        return $this->card_image;
    }

    public function getCardDescription(): ?string
    {
        return $this->card_description;
    }

}
?>