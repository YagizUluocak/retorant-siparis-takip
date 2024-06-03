<?php

class Table extends AbstractModel{
    
    protected $table = 'masa'; 
    protected $id;
    private $table_num;
    private $capacity;
    protected $query;
    

    protected function postTable(){

        $this->table_num = filter_var($_POST['table_num'], FILTER_VALIDATE_INT);
        $this->capacity = filter_var($_POST['capacity'],FILTER_VALIDATE_INT);

        if(!$this->table_num  || !$this->capacity){
            echo "Geçersiz Değer Bir Sayı Giriniz";
            return false;
        }
        return true;
    }

    public function addTable(){

        if(!$this->postTable()){
            return false;
        }

        $stmt = $this->db->prepare("INSERT INTO masa(table_num, capacity) VALUES (:num, :capacity)");
        $stmt->bindParam(':num', $this->table_num);
        $stmt->bindParam(':capacity', $this->capacity);

        try{
            return $stmt->execute();
        }catch(PDOException $e){
            echo "Masa Eklenirken Bir Hata Oluştu: " . $e->getMessage();
            return false;
        }
    }

    public function updateTable(){
        $this->id = $_GET['table_id'];

        if(!$this->postTable()){
            return false;
        }
        return true;

        $this->query = "UPDATE masa SET table_num=:num, capacity=:capacity WHERE table_id=:id";
        $stmt = $this->db->prepare($this->query);
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':num', $this->table_num);
        $stmt->bindParam(':capacity', $this->capacity);

        try{
            return $stmt->execute();
        }catch(PDOException $e){
            echo  $this->id . " Numaralı Masa Güncellenirken Bir Hata Oluştu: " . $e->getMessage();
            return false;
        }
    }
}