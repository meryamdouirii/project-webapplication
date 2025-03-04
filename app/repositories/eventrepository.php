<?php
namespace App\Repositories;

use PDO;

class EventRepository extends Repository { 

    public function getAll() {
        $stmt = $this->connection->prepare("SELECT id, name, description_homepage, banner_description, picture_homepage 
        FROM event");

        $stmt-> execute();
        $stmt-> setFetchMode(PDO::FETCH_CLASS, '\\App\\Models\\Event');
        $result = $stmt-> fetchAll();
        return $result;
    }

    public function getById($id) {
        $stmt = $this->connection->prepare("
            SELECT id, name, description_homepage, banner_description, picture_homepage
            FROM event 
            WHERE id = :id
        ");
    
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    
        // Check of er resultaten zijn
        if ($stmt->rowCount() == 0) {
            die("⚠️ Geen event gevonden met ID: " . $id);
        }
    
        $stmt->setFetchMode(PDO::FETCH_CLASS, '\\App\\Models\\Event');
        $event = $stmt->fetch();
    
        // Debug de output
        // echo "<pre>";
        // print_r($event);
        // echo "</pre>";
        // die();
    
        return $event;
    }
    

}