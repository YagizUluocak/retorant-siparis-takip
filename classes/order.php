<?php

class Order extends AbstractModel {

    protected $table = 'orders';
    private $id;
    private $table_id;
    private $product_id;
    private $amount;
    private $order_status;
    private $query;

    public function postOrder() {
        $this->table_id = filter_var($_POST['table_id'], FILTER_VALIDATE_INT);
        $this->product_id = filter_var($_POST['product_id'], FILTER_VALIDATE_INT);
        $this->amount = filter_var($_POST['amount'], FILTER_VALIDATE_FLOAT);
        $this->order_status = filter_var($_POST['order_status'], FILTER_VALIDATE_INT);

        if (!$this->table_id || !$this->product_id || !$this->amount || !$this->order_status) {
            echo "Geçersiz Değer Girdiniz.";
            return false;
        }
        return true;
    }

    public function addOrder() {
        if (!$this->postOrder()) {
            return false;
        }
        $this->query = "INSERT INTO orders (table_id, product_id, amount, order_status) VALUES (:table_id, :product_id, :amount, :order_status)";
        $stmt = $this->db->prepare($this->query);
        $stmt->bindParam(':table_id', $this->table_id);
        $stmt->bindParam(':product_id', $this->product_id);
        $stmt->bindParam(':amount', $this->amount);
        $stmt->bindParam(':order_status', $this->order_status);
        
        try {
            if ($stmt->execute()) {
                $this->id = $this->db->lastInsertId();
                $totalPrice = $this->calculateTotalPrice($this->id);
                return $this->addPayment($this->id, $totalPrice);
            }
        } catch (PDOException $e) {
            echo "Sipariş Oluşturulurken Bir Hata Oluştu: " . $e->getMessage();
            return false;
        }
    }

    private function calculateTotalPrice($order_id) {
        $query = "
            SELECT SUM(m.price * o.amount) as total_price
            FROM orders o
            JOIN menu m ON o.product_id = m.product_id
            WHERE o.order_id = :order_id
        ";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':order_id', $order_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_price'];
    }

    private function addPayment($order_id, $total_price) {
        $query = "INSERT INTO payments (order_id, total_price, payment_status) VALUES (:order_id, :total_price, 'pending')";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':order_id', $order_id);
        $stmt->bindParam(':total_price', $total_price);
        
        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Ödeme Bilgisi Oluşturulurken Bir Hata Oluştu: " . $e->getMessage();
            return false;
        }
    }

    public function updateOrder() {
        $this->id = filter_var($_GET['order_id'], FILTER_VALIDATE_INT);

        if (!$this->postOrder()) {
            return false;
        }

        $this->query = "UPDATE orders SET table_id=:table_id, product_id=:product_id, amount=:amount, order_status=:order_status WHERE order_id=:id";
        $stmt = $this->db->prepare($this->query);
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':table_id', $this->table_id);
        $stmt->bindParam(':product_id', $this->product_id);
        $stmt->bindParam(':amount', $this->amount);
        $stmt->bindParam(':order_status', $this->order_status);

        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Sipariş Güncelleme Sırasında Bir Hata Oluştu: " . $e->getMessage();
            return false;
        }
    }

    public function getOrderDetailWithPayment() {
        $this->id = filter_var($_GET['order_id'], FILTER_VALIDATE_INT);
        if (!$this->id) {
            echo "Geçersiz Order ID.";
            return false;
        }

        $query = "
            SELECT o.order_id, o.table_id, t.table_name, o.product_id, m.product_name, o.amount, o.order_status, 
                   p.payment_id, p.total_price, p.payment_status 
            FROM orders o 
            JOIN payments p ON o.order_id = p.order_id 
            JOIN tables t ON o.table_id = t.table_id
            JOIN menu m ON o.product_id = m.product_id
            WHERE o.order_id = :order_id
        ";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':order_id', $this->id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getTableOrdersWithPayments() {
        $this->table_id = filter_var($_GET['table_id'], FILTER_VALIDATE_INT);
        if (!$this->table_id) {
            echo "Geçersiz Table ID.";
            return false;
        }

        $query = "
            SELECT o.table_id, t.table_name, o.order_id, o.product_id, m.product_name, o.amount, o.order_status,
                   p.payment_id, p.total_price, p.payment_status 
            FROM orders o 
            JOIN payments p ON o.order_id = p.order_id 
            JOIN tables t ON o.table_id = t.table_id
            JOIN menu m ON o.product_id = m.product_id
            WHERE o.table_id = :table_id
        ";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':table_id', $this->table_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
