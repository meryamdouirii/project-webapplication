<?php
namespace App\Repositories;

use PDO;

class DetailEventRepository extends Repository {

    public function getAll() {
        $stmt = $this->connection->prepare("SELECT id, event_id, banner_description, banner_image, name, description, image_description_1, image_description_2, card_image, card_description, amount_of_stars 
        FROM detail_event");

        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, '\App\Models\DetailEvent');
        $events = $stmt->fetchAll();

        // Fetch tags for each event
        foreach ($events as $event) {
            $event->tags = $this->getTagsForDetailEvent($event->id);
        }

        return $events;
    }

    public function getByMainEvent($id) {
        $stmt = $this->connection->prepare("SELECT id, event_id, banner_description, banner_image, name, description, image_description_1, image_description_2, card_image, card_description, amount_of_stars 
        FROM detail_event
        WHERE event_id = :id");

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, '\App\Models\DetailEvent');
        $events = $stmt->fetchAll();

        // Fetch tags for each event
        foreach ($events as $event) {
            $event->tags = $this->getTagsForDetailEvent($event->id);
        }

        return $events;
    }

    public function getById($id) {
        $stmt = $this->connection->prepare("SELECT id, event_id, banner_description, banner_image, name, description, image_description_1, image_description_2, card_image, card_description, amount_of_stars 
        FROM detail_event
        WHERE id = :id");

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, '\App\Models\DetailEvent');
        $event = $stmt->fetch();

        // Fetch tags for the event
        $event->tags = $this->getTagsForDetailEvent($event->id);

        return $event;
    }

    private function getTagsForDetailEvent($detailEventId) {
        // Fetch tags related to the given detail_event_id
        $stmt = $this->connection->prepare("SELECT name FROM restaurant_tags WHERE detail_event_id = :detail_event_id");
        $stmt->bindParam(':detail_event_id', $detailEventId, PDO::PARAM_INT);
        $stmt->execute();
        $tags = $stmt->fetchAll(PDO::FETCH_COLUMN); // This will return an array of tag names

        return $tags;
    }
}
?>