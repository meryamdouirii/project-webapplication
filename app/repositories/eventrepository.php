<?php
namespace App\Repositories;

use PDO;

class EventRepository {

    protected PDO $connection;

    function __construct() {
        $this->connection = new PDO(
            "mysql:host=mysql;dbname=haarlem_festivaldb",
            "root",
            "secret123"
        );
    }

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