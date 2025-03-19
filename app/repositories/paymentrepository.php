<?php

namespace App\Repositories;
use PDO;

class PaymentRepository extends Repository {

    public function storePayment($orderId, $paymentId, $amount) {
        $sql = "INSERT INTO payment (order_id, payment_id, amount) VALUES (:order_id, :payment_id, :amount)";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([
            ':order_id' => $orderId,
            ':payment_id' => $paymentId,
            ':amount' => $amount
        ]);
    }

    public function updatePaymentStatus($paymentId, $status) {
        $sql = "UPDATE payment SET payment_status = :status WHERE payment_id = :payment_id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([
            ':status' => $status,
            ':payment_id' => $paymentId
        ]);
    }

    // public function getOrderIdByPaymentId($paymentId) {
    //     $sql = "SELECT order_id FROM payment WHERE payment_id = :payment_id";
    //     $stmt = $this->connection->prepare($sql);
    //     $stmt->execute([':payment_id' => $paymentId]);
    //     return $stmt->fetchColumn();
    // }

    // public function getPaymentIdByOrderId($orderId)
    // {
    //     $sql = "SELECT payment_id FROM payment WHERE order_id = :order_id";
    //     $stmt = $this->connection->prepare($sql);
    //     $stmt->execute([':order_id' => $orderId]);
    //     return $stmt->fetchColumn();
    // }
}
