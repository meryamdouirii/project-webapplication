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
                WHERE s.id = :id
                ';
                
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
    public function getSessionsByDetailEventId(int $eventId): array
    {
        $sql = 'SELECT s.*, d.name AS detailEventName 
                FROM session s
                JOIN detail_event d ON s.detail_event_id = d.id
                WHERE s.detail_event_id = :eventId
                ORDER BY s.datetime_start ASC';
                
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
    public function getSessionsByEventId(int $eventId): array
    {
        $sql = 'SELECT s.*, d.name AS detailEventName 
                FROM session s
                JOIN detail_event d ON s.detail_event_id = d.id
                WHERE d.event_id = :eventId
                ORDER BY s.datetime_start ASC';
                
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
    public function insert(Session $session): bool
    {
        $sql = 'INSERT INTO session (detail_event_id, name, description, location, ticket_limit, duration_minutes, price, datetime_start)
                VALUES (:detail_event_id, :name, :description, :location, :ticket_limit, :duration_minutes, :price, :datetime_start)';
        
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute([
            ':detail_event_id' => $session->getDetailEventId(),
            ':name' => $session->getName(),
            ':description' => $session->getDescription() ?: null,
            ':location' => $session->getLocation() ?: null,
            ':ticket_limit' => $session->getTicketLimit(),
            ':duration_minutes' => $session->getDurationMinutes(),
            ':price' => $session->getPrice(),
            ':datetime_start' => $session->getDateTimeStart()
        ]);
    }
    public function update(Session $session): bool
    {
        $sql = 'UPDATE session 
                SET name = :name, description = :description, location = :location, ticket_limit = :ticket_limit, 
                    duration_minutes = :duration_minutes, price = :price, datetime_start = :datetime_start
                WHERE id = :id';
        
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute([
            ':id' => $session->getId(),
            ':name' => $session->getName(),
            ':description' => $session->getDescription() ?: null,
            ':location' => $session->getLocation() ?: null,
            ':ticket_limit' => $session->getTicketLimit(),
            ':duration_minutes' => $session->getDurationMinutes(),
            ':price' => $session->getPrice(),
            ':datetime_start' => $session->getDateTimeStart()
        ]);
    }
    public function delete(int $id): bool
    {
        $sql = 'DELETE FROM session WHERE id = :id';
        
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

}
