<?php
namespace App\Services;

class OrderService
{
    public function getAll() : array
    {
         $repository = new \App\Repositories\OrderRepository();
         return $repository->getAll();
    }
    
    public function placeOrder($order)
    {
        $repository = new \App\Repositories\OrderRepository();
        return $repository->placeOrder($order);
    }
    public function getUserOrders($userId)
    {
        $orderRepository = new \App\Repositories\OrderRepository();
        return $orderRepository->getOrdersByUser($userId);
    }

}