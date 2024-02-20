<?php
include PROJECT_ROOT . '/database/database.php';
class ProductModel {
    
   private $fillable = ['id,product_name','price','quantity','description','deleted'];
   private $TbName = 'products';

   private $db;

    public function __construct(){
        $this->db = new Database();
        
    }
    public function getAllProducts($deleted = 0){ 
        return $this->db->getAllProducts($this->TbName, $deleted);
    }
    public function addProduct($data) {
        if (!is_array($data) || empty($data)) {
            return false;
        }
        return $this->db->insertData($this->TbName, $data); 
    }
    
    public function viewProductDetails($id) {
        return $this->db->getProductDetails($this->TbName,$id);
    }
    public function updateProduct($id, $data) {
        return $this->db->updateProduct($this->TbName,$id, $data);
    }
    public function multiplesoftdelete($ids) {
        return $this->db->multiplesoftdelete($this->TbName, $ids);
    }
    public function recovery($ids) {
        return $this->db->recovery($this->TbName, $ids);
    }
}
?>
