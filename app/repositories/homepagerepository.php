<?php
namespace App\Repositories;

use PDO;

class HomepageRepository extends Repository {

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