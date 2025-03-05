<?php
namespace App\Models;

class Songs
{
   private int $id;

   private int $detail_event_id;

   private string $name;

   private string $photo;

   private string $title;

   private string $description;

   private string $artist;

   private int $duration;

   private string $genre;

   private int $releaseYear;

   public function getId(): int {
       return $this->id;
   }

   public function getName(): string {
       return $this->name;
   }

   public function getArtist(): string {
       return $this->artist;
   }

   public function getDuration(): int {
       return $this->duration;
   }

   public function getGenre(): string {
       return $this->genre;
   }

   public function getReleaseYear(): int {
       return $this->releaseYear;
   }
}
