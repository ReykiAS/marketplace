<?php
require_once('database/database.php');

class ProductController {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function create($product_name, $price, $quantity, $description) {
        $this->db->insertProduct($product_name, $price, $quantity, $description);
    }

    public function update($id, $product_name, $price, $quantity, $description) {
        $this->db->updateProduct($id, $product_name, $price, $quantity, $description);
    }

    public function delete($id) {
        $this->db->softDeleteProduct($id);
    }

    public function multipleDelete($ids) {
        $this->db->multipleSoftDeleteProducts($ids);
    }

    public function restore($id) {
        $this->db->restoreProduct($id);
    }
}
?>
