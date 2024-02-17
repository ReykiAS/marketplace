<?php
include 'Config/init.php';
include PROJECT_ROOT . '/Controller/ProductController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['selected_products'])) {
    $productController = new ProductController();
    $ids = $_POST['selected_products'];
    if ($productController->MultipleSoftDeleteProducts($ids)) {
        // Redirect to index.php with a success message
        header("Location: index.php?soft_delete_success=1");
        exit;
    } else {
        echo "Failed to delete products.";
    }
} else {
    echo "No products selected for deletion.";
}
?>
