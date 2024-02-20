<?php
include PROJECT_ROOT . '/Config/db.php';

class Database {
    private $conn;

    public function __construct() {
        $servername = DB_SERVER;
        $dbname = DB_NAME;
        try {
            $this->conn = new PDO("mysql:host=$servername;dbname=$dbname", DB_USERNAME, DB_PASSWORD);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    private function bindParams($stmt, $params) {
        foreach ($params as $key => &$value) {
            $stmt->bindParam($key, $value);
        }
    }


    public function getAllProducts($table, $deleted = 0) {
        try {

            $stmt = $this->conn->prepare("SELECT * FROM $table WHERE deleted = ?");
            $stmt->execute([$deleted]);
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $products;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    public function insertData($table, $data) {
        try {
            $columns = implode(', ', array_keys($data));
            $values = ':' . implode(', :', array_keys($data));
            $sql = "INSERT INTO $table ($columns) VALUES ($values)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data);
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    

    public function getProductDetails($table, $id) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM $table WHERE id = :id");
    
            $params = array(':id' => $id);
            $this->bindParams($stmt, $params);
    
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    
    public function updateProduct($table, $id, $data) {
        try {
            $query = "UPDATE $table SET ";
            $params = [];
            foreach ($data as $key => $value) {
                $query .= "$key = ?, ";
                $params[] = $value;
            }
            $query = rtrim($query, ", ");
            $query .= " WHERE id = ?";
            $params[] = $id;
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return true;
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    public function multiplesoftdelete($table, $ids) {
        try {
            $placeholders = implode(',', array_fill(0, count($ids), '?'));
            $stmt = $this->conn->prepare("UPDATE $table SET `deleted` = 1 WHERE id IN ($placeholders)");
            $stmt->execute($ids);
            return true;
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    public function recovery($table, $ids) {
        try {
            $placeholders = implode(',', array_fill(0, count($ids), '?'));
            $query = "UPDATE $table SET deleted = 0 WHERE id IN ($placeholders)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute($ids);
    
            return true;
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    
    
    
}



?>
<!-- // membuat query menjadi generel di class database -->