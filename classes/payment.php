<?php
class Payment extends AbstractModel{

protected $table = 'payments';
protected $id;
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
public function getPaymentsByTable(){
    $query = 
    "SELECT 
    t.table_num,
    m.product_name,
    p.payment_status,
    p.order_id,
    p.payment_id,
    SUM(o.amount) AS total_quantity,
    SUM(p.total_price) AS total_price
    FROM
        payments p
    JOIN orders o ON p.order_id = o.order_id
    JOIN menu m ON o.product_id = m.menu_id
    JOIN masa t ON o.table_id = t.table_id
    GROUP BY t.table_num, m.product_name
    ";

    $stmt = $this->db->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll();
}
}
