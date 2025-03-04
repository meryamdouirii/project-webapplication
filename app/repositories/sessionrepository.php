<?php
namespace App\Repositories;

use App\Models\Session;
use PDO;

class SessionRepository extends Repository
{
    public function getById(int $id): ?Session
    {
        $sql = 'SELECT s.*, d.name AS detailEventName 
                FROM session s
                JOIN detail_event d ON s.detail_event_id = d.id
                WHERE s.id = :id';
                
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
            $row['detailEventName'], 
            $row['description'],
            $row['location'],
            $row['ticket_limit'],
            $row['duration_minutes'],
            (float)$row['price'],
            $row['datetime_start']
        );
    }

    public function getAll(): array
    {
        $sql = 'SELECT s.*, d.name AS detailEventName 
                FROM session s
                JOIN detail_event d ON s.detail_event_id = d.id
                ORDER BY s.datetime_start ASC';
        
        $stmt = $this->connection->query($sql);
        $results = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $results[] = new Session(
                $row['id'],
                $row['detail_event_id'],
                $row['name'], 
                $row['detailEventName'], 
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

    public function getSessionsByEventId(int $eventId): array
    {
        $sql = 'SELECT s.*, d.name AS detailEventName 
                FROM session s
                JOIN detail_event d ON s.detail_event_id = d.id
                WHERE s.event_id = :eventId';
                
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':eventId', $eventId, PDO::PARAM_INT);
        $stmt->execute();
        $results = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $results[] = new Session(
                $row['id'],
                $row['detail_event_id'],
                $row['name'], 
                $row['detailEventName'], 
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
        $sql = 'SELECT s.*, d.name AS detailEventName 
                FROM session s
                JOIN detail_event d ON s.detail_event_id = d.id
                WHERE s.detail_event_id = :eventId';

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
            $row['name'], // ✅ Keep session name
            $row['detailEventName'], // ✅ Fetch `detail_event.name`
            $row['description'],
            $row['location'],
            $row['ticket_limit'],
            $row['duration_minutes'],
            (float)$row['price'],
            $row['datetime_start']
        );
    }
}
