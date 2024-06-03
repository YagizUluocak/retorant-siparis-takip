<?php
include "db.class.php";
abstract class AbstractModel{
    protected $db;
    protected $table;
    protected $id;
    protected $query;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnect();
    }
    public function getAll(){
        $stmt = $this->db->prepare("SELECT * FROM " . $this->table);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getOrder($filter = null, $completed = null) {
        $query = "SELECT 
                    o.order_id, 
                    SUM(o.amount) AS amount,
                    MAX(o.order_status) AS order_status,
                    t.table_num,
                    m.product_name
                FROM 
                    orders o
                JOIN
                    masa t ON o.table_id = t.table_id
                JOIN
                    menu m ON o.product_id = m.menu_id";
    
        if ($filter == 'pending') 
        {
            $query .= " WHERE o.order_status = 0 ";
        } 
        else if ($completed == 'tamamlandı')
        {
            $query .= " WHERE o.order_status = 1 ";
        }

    
        $query .= " GROUP BY t.table_num, m.product_name";
    
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    

    public function getById($id, $idcolumn){
        $stmt = $this->db->prepare("SELECT * FROM ". $this->table . " WHERE " . $idcolumn . "=:id"); //table_id , employee_id (tableName . _id)
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function deleteById($id){
        $stmt = $this->db->prepare("DELETE FROM " . $this->table . " WHERE " . $this->table . "_id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    /* Tek bir method üzerinden veri Ekleme 
    public function addItem($table, $columns, $values)
    {

        $columnStr = implode(', ', $columns);
        $paramStr = ':' . implode(', :', $columns); // :table_id, :product_name, :price ....

        $stmt = $this->db->prepare("INSERT INTO " . $table . "(" . $columnStr . ") VALUES ( " . $paramStr . ")" );
        $ParamArray = array_combine($columns , $values);
        $stmt->execute($ParamArray);
    }
    */
}