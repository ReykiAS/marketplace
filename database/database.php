<?php
include('Config/db.php');
class Database {
    private $conn;

    public function __construct() {
        $servername = DB_SERVER;
        $dbname = DB_NAME;
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", DB_USERNAME, DB_PASSWORD);
            // Set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             echo "Connected successfully";
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            }
        }
        public function insertProduct($product_name, $price, $quantity, $description) {
            $stmt = $this->conn->prepare("INSERT INTO products (product_name, price, quantity, description) VALUES (?, ?, ?, ?)");
            $stmt->execute([$product_name, $price, $quantity, $description]);
        }
    
        public function updateProduct($id, $product_name, $price, $quantity, $description) {
            $stmt = $this->conn->prepare("UPDATE products SET product_name = ?, price = ?, quantity = ?, description = ? WHERE id = ?");
            $stmt->execute([$product_name, $price, $quantity, $description, $id]);
        }
    
        public function softDeleteProduct($id) {
            $stmt = $this->conn->prepare("UPDATE products SET deleted_at = NOW() WHERE id = ?");
            $stmt->execute([$id]);
        }
    
        public function multipleSoftDeleteProducts($ids) {
            $ids_str = implode(',', $ids);
            $stmt = $this->conn->query("UPDATE products SET deleted_at = NOW() WHERE id IN ({$ids_str})");
        }
    
        public function restoreProduct($id) {
            $stmt = $this->conn->prepare("UPDATE products SET deleted_at = NULL WHERE id = ?");
            $stmt->execute([$id]);
        }
    
    
     

}