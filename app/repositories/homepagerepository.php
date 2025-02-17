<?php
namespace App\Repositories;

use PDO;

class HomepageRepository {

    protected PDO $connection;

    function __construct() {
        $this->connection = new PDO(
            "mysql:host=mysql;dbname=haarlem_festivaldb",
            "root",
            "secret123"
        );
    }

    public function getAll() {
        $stmt = $this->connection->prepare("SELECT id, name, banner_image, banner_description FROM homepage");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, '\\App\\Models\\Homepage');
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->connection->prepare("SELECT id, name, banner_image, banner_description FROM homepage WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, '\\App\\Models\\Homepage');
        return $stmt->fetch();
    }
}
?>