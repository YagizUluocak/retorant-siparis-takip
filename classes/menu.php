<?php

class Menu extends AbstractModel{
    protected $table = 'menu';
    protected $id;
    private $product;
    private $category;
    private $price;
    private $query;

    public function postMenu(){
        // Verileri POST isteğinden al ve sanitize et
        $this->product = htmlspecialchars($_POST['product_name']);
        $this->category = htmlspecialchars($_POST['category']);
        $this->price = filter_var($_POST['price'], FILTER_VALIDATE_FLOAT);
        
        if(!$this->price){
            echo "Geçersiz Fiyat Değeri.";
            return false;
        }
        return true;
    }

    public function addMenu(){

        if(!$this->postMenu()){
            return false;
        }
        // SQL sorgusunu hazırla
        $this->query = "INSERT INTO menu(product_name, category, price) VALUES (:product_name, :category, :price)";
        $stmt = $this->db->prepare($this->query);
        $stmt->bindParam(':product_name', $this->product);
        $stmt->bindParam(':category', $this->category);
        $stmt->bindParam(':price', $this->price);

        try{
            return $stmt->execute();
        }catch(PDOException $e){
            echo "Menü Eklenirken Bir Hata Oluştu: " . $e->getMessage();
            return false;
        }
    }
    public function updateMenu(){
        $this->id = $_GET['menu_id'];
        if (!$this->postMenu()) {
            return false;
        }

        $this->query = "UPDATE menu SET product_name=:product_name, category=:category, price=:price WHERE menu_id=:id";
        $stmt = $this->db->prepare($this->query);
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':product_name', $this->product);
        $stmt->bindParam(':category', $this->category);
        $stmt->bindParam(':price', $this->price);

        try{
            return $stmt->execute();
        }catch(PDOException $e){
            echo "Güncelleme Sırasında Bir Hata Oluştu: " . $e->getMessage();
            return false;
        }
    }
}