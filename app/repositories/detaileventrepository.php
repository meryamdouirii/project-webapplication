<?php
namespace App\Repositories;
use App\Models\DetailEvent;
use App\Models\Session;
use PDO;

class DetailEventRepository extends Repository
{

    public function add(DetailEvent $detailEvent): bool
{
    try {
        $this->connection->beginTransaction();

        $sql = 'INSERT INTO detail_event 
                (event_id, banner_description, banner_image, name, description, image_description_1, image_description_2, card_image, card_description, amount_of_stars) 
                VALUES 
                (:event_id, :banner_description, :banner_image, :name, :description, :image_description_1, :image_description_2, :card_image, :card_description, :amount_of_stars)';
        
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([
            ':event_id' => $detailEvent->getEventId(),
            ':banner_description' => $detailEvent->getBannerDescription(),
            ':banner_image' => $detailEvent->getBannerImage(),
            ':name' => $detailEvent->getName(),
            ':description' => $detailEvent->getDescription(),
            ':image_description_1' => $detailEvent->getImageDescription1(),
            ':image_description_2' => $detailEvent->getImageDescription2(),
            ':card_image' => $detailEvent->getCardImage(),
            ':card_description' => $detailEvent->getCardDescription(),
            ':amount_of_stars' => $detailEvent->getAmountOfStars(),
        ]);
        $detailEventId = $this->connection->lastInsertId();

        if (!empty($detailEvent->getTags())) {
            $tagSql = "INSERT INTO detail_event_card_tag (detail_event_id, tag) VALUES (:detail_event_id, :tag)";
            $tagStmt = $this->connection->prepare($tagSql);
            
            foreach ($detailEvent->getTags() as $tag) {
                $tagStmt->execute([
                    ':detail_event_id' => $detailEventId,
                    ':tag' => $tag
                ]);
            }
        }

        $this->connection->commit();
        return true;
        
    } catch (Exception $e) {
        $this->connection->rollBack();
        error_log("Error adding DetailEvent: " . $e->getMessage());
        return false;
    }
}

    public function getByMainEvent($id)
    {
        $sql = 'SELECT * FROM detail_event WHERE event_id = :id';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $results = [];
    
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $sessions = $this->getSessionsForDetailEvent($row['id']); // Ophalen van sessies voor dit detailEvent
            
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
                $row['card_description'],
                $row['amount_of_stars'],
                $this->getTagsForDetailEvent($row['id']),
                $sessions // Voeg de sessies toe aan het object
            );
        }
    
        return $results;
    }
    


    private function getTagsForDetailEvent($detailEventId)
    {
        // Fetch tags related to the given detail_event_id
        $stmt = $this->connection->prepare("SELECT tag FROM detail_event_card_tag WHERE detail_event_id = :detail_event_id");
        $stmt->bindParam(':detail_event_id', $detailEventId, PDO::PARAM_INT);
        $stmt->execute();
        $tags = $stmt->fetchAll(PDO::FETCH_COLUMN); // This will return an array of tag names

        return $tags;
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

        return new DetailEvent(
            $row['id'],
            $row['event_id'],
            $row['banner_description'],
            $row['banner_image'],
            $row['name'],
            $row['description'],
            $row['image_description_1'],
            $row['image_description_2'],
            $row['card_image'],
            $row['card_description'],
            $row['amount_of_stars'],
            $this->getTagsForDetailEvent($row['id'])
        );

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
                $row['card_description'],
                $row['amount_of_stars'],
                $this->getTagsForDetailEvent($row['id'])
            );
        }
        return $results;
    }

    private function getSessionsForDetailEvent(int $detailEventId): array
    {
        $stmt = $this->connection->prepare("
        SELECT * FROM session WHERE detail_event_id = :detail_event_id
    ");
        $stmt->bindParam(':detail_event_id', $detailEventId, PDO::PARAM_INT);
        $stmt->execute();
        $sessions = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $sessions[] = new Session(
                $row['id'],
                $row['detail_event_id'],
                $row['name'],
                $row['description'],
                $row['location'],
                $row['ticket_limit'],
                $row['duration_minutes'],
                $row['price'],
                $row['datetime_start']
            );
        }
        return $sessions;
    }

}
?>