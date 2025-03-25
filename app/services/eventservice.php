<?php
namespace App\Services;

class EventService {
    public function getAll() {
        $repository = new \App\Repositories\EventRepository();
        return $repository->getAll();
    }
    public function getById($id){
        $repository = new \App\Repositories\EventRepository();
        return $repository->getById($id);
    }
    public function update($event){
        $repository = new \App\Repositories\EventRepository();
        return $repository->update($event);
    }
}