<?php
include PROJECT_ROOT . '/model/ProductModel.php';


class ProductController {

        private $model;
    
        public function __construct(){
            $this->model = new ProductModel();
        }
        // Action to get all products
        public function getAllProducts(){
            return $this->model->getAllProducts();
        }
        public function addProduct($table, $data) {
            return $this->model->addProduct($table, $data);
        }
        public function viewProductDetails($id) {
            return $this->model->viewProductDetails($id);
        }
    
        public function softDeleteProduct($product_id) {
            $success = $this->model->softDeleteProduct($product_id);
            if ($success) {
                echo "Product soft deleted successfully.";
            } else {
                echo "Failed to soft delete product.";
            }
        }
        public function updateProduct($id, $data) {
            $productModel = new ProductModel();
            return $productModel->updateProduct($id, $data);
        }
        public function MultipleSoftDeleteProducts($ids) {
            return $this->model->multiplesoftdelete($ids);
        }
        public function Recoverydata(){
            return $this->model->Recoverydata();
        }
        public function recovery($ids){
            return $this->model->recovery($ids);
        }
    }
    ?>

