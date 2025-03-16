<?php
namespace App\Repositories;
use App\Models\DetailEvent;
use App\Models\Session;
use App\Models\Songs;
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

        $sessions = $this->getSessionsForDetailEvent($row['id']);
        $songs = $this->getSongsForDetailEvent($row['id']);
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
            $this->getTagsForDetailEvent($row['id']),
            $sessions,
            $songs
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

        //TODO: geen QUERIES in een loop
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

    public function getSessionsForDetailEvent(int $detailEventId): array
    {
        $sql = 'SELECT s.*, d.name AS detailEventName
                FROM session s
                JOIN detail_event d ON s.detail_event_id = d.id
                WHERE s.detail_event_id = :detailEventId';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':detailEventId', $detailEventId, PDO::PARAM_INT);
        $stmt->execute();
        $results = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $results[] = new Session(
                $row['id'],
                $row['detail_event_id'],
                $row['name'], // session name
                $row['detailEventName'] ?? "Unknown Event", // detail_event name; provide default if null
                $row['description'],
                $row['location'],
                (int) $row['ticket_limit'],
                (int) $row['duration_minutes'],
                (float) $row['price'], // <--- This cast is required!
                $row['datetime_start']
            );
        }
        return $results;
    }

    public function getSongsForDetailEvent(int $detailEventId): array
    {
        $sql = 'SELECT s.*, d.name AS detailEventName
                FROM session s
                JOIN detail_event d ON s.detail_event_id = d.id
                WHERE s.detail_event_id = :detailEventId';

        $sql = 'SELECT s.*, d.name AS detailEventName
        FROM song s
        JOIN detail_event d ON s.detail_event_id = d.id
        WHERE s.detail_event_id = :detailEventId';

        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':detailEventId', $detailEventId, PDO::PARAM_INT);
        $stmt->execute();
        $results = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $results[] = new Songs(
                $row['id'],
                $row['detail_event_id'],
                $row['name'] ?? "Unknown Name",
                $row['photo'] ?? "default.jpg",
                $row['title'] ?? "Unknown Title",
                $row['description'] ?? "No description available"
            );
        }
        return $results;
    }
    public function updateContent(string $content, string $type, int $eventId): bool
    {
        $validColumns = ['banner_image', 'banner_description', 'name', 'description', 'image_description_1', 'image_description_2', 'card_image', 'card_description', 'amount_of_stars'];
        if (!in_array($type, $validColumns)) {
            throw new InvalidArgumentException("Invalid column type: $type");
        }
        $sql = "UPDATE detail_event SET $type = :content WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([
            ':content' => $content,
            ':id' => $eventId
        ]);
        return true;
    }

}
?>