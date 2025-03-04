<?php
namespace App\Repositories;

use App\Models\Session;
use PDO;

class SessionRepository extends Repository
{

    public function getById(int $id): ?Session
    {
        $sql = 'SELECT * FROM session WHERE id = :id';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return new Session(
            $row['id'],
            $row['detail_event_id'],
            $row['name'],
            $row['description'],
            $row['location'],
            $row['ticket_limit'],
            $row['duration_minutes'],
            (float)$row['price'],
            $row['datetime_start']
        );
    }

    /**
     * @return Session[]
     */
    public function getAll(): array
    {
        $sql = 'SELECT * FROM session';
        $stmt = $this->connection->query($sql);
        $results = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $results[] = new Session(
                $row['id'],
                $row['detail_event_id'],
                $row['name'],
                $row['description'],
                $row['location'],
                $row['ticket_limit'],
                $row['duration_minutes'],
                (float)$row['price'],
                $row['datetime_start']
            );
        }

        return $results;
    }
    public function getSessionsByEventId(int $eventId) :array{
        $sql = 'SELECT * FROM session WHERE detail_event_id = :eventId';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':eventId', $eventId, PDO::PARAM_INT);
        $stmt->execute();
        $results = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $results[] = new Session(
                $row['id'],
                $row['detail_event_id'],
                $row['name'],
                $row['description'],
                $row['location'],
                $row['ticket_limit'],
                $row['duration_minutes'],
                (float)$row['price'],
                $row['datetime_start']
            );
        }

        return $results;
    }
    public function getByEventId(int $eventId): ?Session
    {
        $sql = 'SELECT * FROM session WHERE detail_event_id = :eventId';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':eventId', $eventId, PDO::PARAM_INT);
        $stmt->execute();   
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return new Session(
            $row['id'],
            $row['detail_event_id'],
            $row['name'],
            $row['description'],
            $row['location'],
            $row['ticket_limit'],
            $row['duration_minutes'],
            (float)$row['price'],
            $row['datetime_start']
        );
    }

}
