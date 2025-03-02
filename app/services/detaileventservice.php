<?php
namespace App\Services;

class DetailEventService {
    public function getAll() {
        $repository = new \App\Repositories\DetailEventRepository();
        return $repository->getAll();
    }
    public function getById($id){
        $repository = new \App\Repositories\DetailEventRepository();
        return $repository->getById($id);
    }
    public function getByMainEvent($id){
        $repository = new \App\Repositories\DetailEventRepository();
        return $repository->getByMainEvent($id);
    }
}