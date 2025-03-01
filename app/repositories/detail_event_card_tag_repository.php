<?php
namespace App\Repositories;

use App\Models\DetailEventCardTag;
use PDO;

class DetailEventCardTagRepository extends Repository
{
    public function getById(int $id): ?DetailEventCardTag
    {
        $sql = 'SELECT * FROM detail_event_card_tag WHERE id = :id';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return new DetailEventCardTag(
            $row['id'],
            $row['detail_event_id'],
            $row['tag']
        );
    }

    /**
     * @return DetailEventCardTag[]
     */
    public function getAll(): array
    {
        $sql = 'SELECT * FROM detail_event_card_tag';
        $stmt = $this->connection->query($sql);
        $results = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $results[] = new DetailEventCardTag(
                $row['id'],
                $row['detail_event_id'],
                $row['tag']
            );
        }

        return $results;
    }
}
