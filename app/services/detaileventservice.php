<?php
    namespace App\Services;
    use App\Models\DetailEvent;

    class DetailEventService {
        
        public function getByMainEvent($id){
            $repository = new \App\Repositories\DetailEventRepository();
            return $repository->getByMainEvent($id);
        }
        public function getById(int $id): ?DetailEvent
        {
            $repository = new \App\Repositories\DetailEventRepository();
            return $repository->getById($id);
        }

        public function getSessionsForDetailEvent(int $detailEventId): array
        {
            $repository = new \App\Repositories\DetailEventRepository();
            return $repository->getSessionsForDetailEvent($detailEventId);
        }

        /**
         * @return DetailEvent[]
         */
        public function getAll(): array
        {
            $repository = new \App\Repositories\DetailEventRepository();
            return $repository->getAll();
        }
    }
