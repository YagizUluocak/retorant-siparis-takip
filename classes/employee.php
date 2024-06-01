<?php

class Employee extends AbstractModel{
    protected $table = 'employees';
    protected $id;
    private $name;
    private $position;
    private $query;

    //Take post
    public function postEmployee(){
        $this->name = htmlspecialchars($_POST['personel_name']);
        $this->position = htmlspecialchars($_POST['position']);
        
        return true;
    }
    
    //Add a new Employee
    public function addEmployee(){
        if(!$this->postEmployee()){
            return false;
        }

        $this->query = "INSERT INTO employees(personel_name, position) VALUES (:personel_name, :position)";
        $stmt = $this->db->prepare($this->query);
        $stmt->bindParam(':personel_name', $this->name);
        $stmt->bindParam(':position', $this->position);

        try{
            return $stmt->execute();
        }catch(PDOException $e){
            echo "Personel Eklenirken Bir Hata Oluştu: " . $e->getMessage();
            return false;
        }
    }

    //Update Employee
    public function updateEmployee(){
        $this->id = $_GET['personel_id'];

        if(!$this->postEmployee()){
            return false;
        }

        $this->query = "UPDATE employees SET personal_name=:name, position=:position WHERE personel_id=:id";
        $stmt = $this->db->prepare($this->query);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':position', $this->position);
        $stmt->bindParam(':id', $this->id);

        try{
            return $stmt->execute();
        }catch(PDOException $e){
            echo $this->id ." Numaralı Personel Güncelleme Sırasında Bir Hata Oluştu: " . $e->getMessage();
            return false;
        }
    }
}