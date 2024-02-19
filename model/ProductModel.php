<?php
include PROJECT_ROOT . '/database/database.php';
class ProductModel {
    
   private $fillable = ['id,product_name','price','quantity','description'];

   private $db;

    public function __construct(){
        $this->db = new Database();
        
    }

    // Get all products from database
    public function getAllProducts(){ 
        return $this->db->getAllProducts();
    }
    public function addProduct($table, $data) {
        if (!is_array($data) || empty($data)) {
            return false;
        }
        return $this->db->insertData($table, $data);
    }
    
    public function viewProductDetails($id) {
        return $this->db->getProductDetails($id);
    }
    public function softDeleteProduct($product_id) {
        return $this->db->softDeleteProduct($product_id);
    }
    public function updateProduct($id, $data) {
        return $this->db->updateProduct($id, $data);
    }
    public function multiplesoftdelete($ids) {
        return $this->db->multiplesoftdelete('products', $ids);
    }
    public function Recoverydata(){ 
        return $this->db->recoveryData();
    }
    public function recovery($ids) {
        return $this->db->recovery('products', $ids);
    }
}
?>
