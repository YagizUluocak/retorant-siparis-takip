<?php
class Payment extends AbstractModel{

protected $table = 'payments';
private $id;
private $order_id;
private $total_price;
private $payment_status;

// Get payment information for the order
public function getPaymentByOrder($order_id){
    $query = 
    "SELECT payment_id, order_id, total_price, payment_status
    FROM payments 
    WHERE order_id = :order_id";

    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':order_id', $order_id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Get payment information for all orders for the table
public function getPaymentsByTable($table_id){
    $query = 
    "SELECT p.payment_id, p.order_id, p.total_price, p.payment_status
    FROM payments p
    JOIN orders o ON p.order_id = o.order_id
    WHERE o.table_id = :table_id";

    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':table_id', $table_id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}
