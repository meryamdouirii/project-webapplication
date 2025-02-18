<?php
namespace App\Services;

class HomepageService {
    public function getAll() {
        $repository = new \App\Repositories\HomepageRepository();
        return $repository->getAll();
    }
    public function getById($id){
        $repository = new \App\Repositories\HomepageRepository();
        return $repository->getById($id);
    }
}