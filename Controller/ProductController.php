<?php
include PROJECT_ROOT . '/model/ProductModel.php';


class ProductController {

        private $model;
    
        public function __construct(){
            $this->model = new ProductModel();
        }
        public function getAllProducts($deleted = 0){
            return $this->model->getAllProducts($deleted);
        }
        public function addProduct($data) {
            return $this->model->addProduct($data);
        }
        public function viewProductDetails($id) {
            return $this->model->viewProductDetails($id);
        }
    
        public function softDeleteProduct($ids) {
            $success = $this->model->softDeleteProduct([$ids]);
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

        public function recovery($ids){
            return $this->model->recovery($ids);
        }
    }
    ?>

