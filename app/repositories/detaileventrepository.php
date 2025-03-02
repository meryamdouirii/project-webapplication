<?php
namespace App\Repositories;
use PDO;

class DetailEventRepository extends Repository {


    public function getByMainEvent($id) {
        $sql = 'SELECT * FROM detail_event WHERE event_id = :id';
        $stmt = $this->connection->query($sql);
        $results = [];


        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $results[] = new DetailEvent(
                $row['id'],
                $row['event_id'],
                $row['banner_description'],
                $row['banner_image'],
                $row['name'],
                $row['description'],
                $row['image_description_1'],
                $row['image_description_2'],
                $row['card_image'],
                $row['card_description']
            );
        }
        foreach ($results as $event) {
            $event->tags = $this->getTagsForDetailEvent($event->id);
        }
        return $results;
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
    public function getById(int $id): ?DetailEvent
    {
        $sql = 'SELECT * FROM detail_event WHERE id = :id';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        $event = new DetailEvent(
            $row['id'],
            $row['event_id'],
            $row['banner_description'],
            $row['banner_image'],
            $row['name'],
            $row['description'],
            $row['image_description_1'],
            $row['image_description_2'],
            $row['card_image'],
            $row['card_description']
        );
        $event->tags = $this->getTagsForDetailEvent($event->id);
        return $event;
    }

    /**
     * @return DetailEvent[]
     */       
    public function getAll(): array
    {
        $sql = 'SELECT * FROM detail_event';
        $stmt = $this->connection->query($sql);
        $results = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $results[] = new DetailEvent(
                $row['id'],
                $row['event_id'],
                $row['banner_description'],
                $row['banner_image'],
                $row['name'],
                $row['description'],
                $row['image_description_1'],
                $row['image_description_2'],
                $row['card_image'],
                $row['card_description']
            );
        }
        foreach ($results as $event) {
            $event->tags = $this->getTagsForDetailEvent($event->id);
        }
        return $results;
    }
?>
