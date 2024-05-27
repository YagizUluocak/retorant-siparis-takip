<?php

class Menu extends AbstractModel{
    protected $table = 'menu';

    private $product;
    private $category;
    private $price;
    private $query;

    public function addMenu(){

        // Verileri POST isteğinden al ve sanitize et
        $this->product = htmlspecialchars($_POST['product']);
        $this->category = htmlspecialchars($_POST['category']);
        $this->price = filter_var($_POST['price'], FILTER_VALIDATE_FLOAT);

        if(!$this->price){
            echo "Geçersiz Fiyat Değeri.";
            return false;
        }
        // SQL sorgusunu hazırla
        $this->query = "INSERT INTO menu(product_name, category, price) VALUES (:product_name, :category, :price)";
        $stmt = $this->db->prepare($this->query);
        $stmt->bindParam(':product', $this->product);
        $stmt->bindParam(':category', $this->category);
        $stmt->bindParam(':price', $this->price);

        try{
            return $stmt->execute();
        }catch(PDOException $e){
            echo "Menü Eklenirken Bir Hata Oluştu: " . $e->getMessage();
            return false;
        }
    }
}