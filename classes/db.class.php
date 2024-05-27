<?php
class Database{
    private static $instance = null;
    private $conn;

    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "restorantdb";

    // Singleton deseni ile tek bir bağlantı noktası sağlanır
    public static function getInstance(){
        if(!self::$instance){
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct(){
        try{
            $dsn = "mysql:host=".$this->host.";dbname=".$this->dbname; 
            $this->conn = new PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        }catch(PDOException $e){
            throw new Exception("Bağlantı Hatası: " .$e->getMessage());
        }
    }

    public function getConnect(){
        return $this->conn;
    }
}


$db = Database::getInstance();
$conn = $db->getConnect();