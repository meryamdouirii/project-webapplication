<?php
namespace App\Repositories;

use PDO;

class EventRepository extends Repository { 

    public function getAll() {
        $stmt = $this->connection->prepare("SELECT id, name, description_homepage, banner_description, picture_homepage 
        FROM event");

        $stmt-> execute();
        $stmt-> setFetchMode(PDO::FETCH_CLASS, '\App\Models\Event');
        $result = $stmt-> fetchAll();
        return $result;
    }

    public function getById($id) {
        $stmt = $this->connection->prepare("SELECT id, name, description_homepage, banner_description, picture_homepage
        FROM event 
        WHERE id = :id");

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, '\App\Models\event');
        return $stmt->fetch();
    }

}