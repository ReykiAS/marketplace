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


    public function getAllProducts() {
        try {
            $stmt = $this->conn->query("SELECT *, FORMAT((price * quantity), 0, 'id_ID') AS total_price FROM products WHERE deleted = 0");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
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

    public function getProductDetails($id) {
        try {
            $stmt = $this->conn->prepare("SELECT id, product_name, price, quantity, description FROM products WHERE id = :id");
    
            $params = array(':id' => $id);
            $this->bindParams($stmt, $params);
    
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    
    public function softDeleteProduct($product_id) {
        try {
            $stmt = $this->conn->prepare("UPDATE products SET deleted = 1 WHERE id = :product_id");
            $params = array(
                ':product_id' => $product_id,
            );

            $this->bindParams($stmt, $params);
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    public function updateProduct($id, $data) {
        try {
            $stmt = $this->conn->prepare("UPDATE products SET product_name = ?, price = ?, quantity = ?, description = ? WHERE id = ?");
            $stmt->execute([$data['product_name'], $data['price'], $data['quantity'], $data['description'], $id]);
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
    public function recoveryData() {
        try {
            $stmt = $this->conn->query("SELECT * FROM products WHERE deleted = 1");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    public function recovery($table, $ids) {
        try {
            $placeholders = implode(',', array_fill(0, count($ids), '?'));
            $stmt = $this->conn->prepare("UPDATE $table SET `deleted` = 0 WHERE id IN ($placeholders)");
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