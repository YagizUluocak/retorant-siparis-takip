<?php

// Veri Getirme methoduna sorgu eklenilcek unutma

class Order extends AbstractModel{

    protected $table = 'orders';
    private $id;
    private $table_id;
    private $product_id;
    private $amount;
    private $order_status;
    private $query;

    public function postOrder(){
        $this->table_id = filter_var($_POST['table_id'], FILTER_VALIDATE_INT);
        $this->product_id = filter_var($_POST['product_id'], FILTER_VALIDATE_INT);
        $this->amount = filter_var($_POST['amount'], FILTER_VALIDATE_FLOAT);
        $this->order_status = filter_var($_POST['order_status'], FILTER_VALIDATE_INT);

        if(!$this->table_id && $this->product_id && $this->order_status && $this->order_status){
            echo "Geçersiz Değer Girdiniz.";
            return false;
        }
        return true;
    }
    public function addOrder(){
        if(!$this->postOrder()){
            return false;
        }
        $this->query = "INSERT INTO orders(table_id, product_id, amount, order_status) VALUES (:table_id, :product_id, :amount, :order_status)"; 
        $stmt = $this->db->prepare($this->query);
        $stmt->bindParam(':table_id', $this->table_id);
        $stmt->bindParam(':product_id', $this->product_id);
        $stmt->bindParam(':amount', $this->amount);
        $stmt->bindParam(':order_status', $this->order_status);
        
        try{
            return $stmt->execute();
        }catch(PDOException $e){
            "Sipariş Oluşturulurken Bir Hata Oluştu: " . $e->getMessage();
            return false;
        }
    }

    public function updateOrder(){
        $this->id = $_GET['order_id'];

        if(!$this->postOrder()){
            return false;
        }
        return true;

        $this->query = "UPDATE orders SET table_id=:table_id, product_id=:product_id, amount=:amount, order_status=:order_status WHERE order_id=:id";
        $stmt = $this->db->prepare($this->query);
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':table_id', $this->table_id);
        $stmt->bindParam(':amount', $this->amount);
        $stmt->bindParam(':order_status', $this->order_status);

        try{
            return $stmt->execute();
        }catch(PDOException $e){
            echo "Sipariş Güncelleme Sırasında Bir Hata Oluştu: " . $e->getMessage();
            return false;
        }
    }
}