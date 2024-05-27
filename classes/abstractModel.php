<?php

abstract class AbstractModel{
    protected $db;
    protected $table;
    protected $id;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnect();
    }
    public function getAll(){
        $stmt = $this->db->prepare("SELECT * FROM " . $this->table);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getById($id){
        $stmt = $this->db->prepare("SELECT * FROM ". $this->table . " WHERE " . $this->table . "_id=:id"); //table_id , employee_id (tableName . _id)
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function deleteById($id){
        $stmt = $this->db->prepare("DELETE FROM " . $this->table . " WHERE " . $this->table . "_id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}