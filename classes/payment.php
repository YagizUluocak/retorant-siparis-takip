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
public function getPaymentsByTableId($payment_id){
    $query = "SELECT 
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
    WHERE p.payment_id = :payment_id
    GROUP BY t.table_num, m.product_name, p.payment_status, p.order_id, p.payment_id
    ";

    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':payment_id', $payment_id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetching as associative array
}
public function getPaymentById($id){
    $stmt = $this->db->prepare("SELECT * FROM payment WHERE payment_id=:id");
    $stmt->bindParam(':id', $id);
    return $stmt->execute();

}
public function odemeYap()
{
    $this->id = filter_var($_GET['payment_id'], FILTER_VALIDATE_INT);

    $this->query = "UPDATE payments SET payment_status = 1 WHERE payment_id=:id";
    $stmt = $this->db->prepare($this->query);
    $stmt->bindParam(':id', $this->id);

    try{
        return $stmt->execute();
    }catch(PDOException $e){
        echo "Ödeme İşlemi Sırasında Bir Sorun Oluştu: " . $e->getMessage();
        return false;
    }
}
public function getPayment($filter = null, $odenmis = null)
{
    $query = "SELECT 
    t.table_num,
    m.product_name,
    MAX(p.payment_status) AS payment_status,
    p.order_id,
    p.payment_id,
    SUM(o.amount) AS total_quantity,
    SUM(p.total_price) AS total_price
    FROM
        payments p
    JOIN orders o ON p.order_id = o.order_id
    JOIN menu m ON o.product_id = m.menu_id
    JOIN masa t ON o.table_id = t.table_id";

    if($filter == 'odenmemis')
    {
        $query .= " WHERE p.payment_status = 0 ";
    }
    else if ($odenmis == 'odendi')
    {
        $query .= " WHERE p.payment_status = 1 ";
    }
    $query .= " GROUP BY p.payment_id";
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll();
}

}
