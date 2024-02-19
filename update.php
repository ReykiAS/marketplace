<?php
include 'Config/init.php';
include PROJECT_ROOT . '/Controller/ProductController.php';

$productController = new ProductController();
$message = ""; // Variabel message dideklarasikan di awal dengan string kosong

// Check if product ID is provided in the URL
if(isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Get product details from the controller
    $productDetails = $productController->viewProductDetails($product_id);

    // Check if product details are retrieved successfully
    if($productDetails) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = array(
                'product_name' => $_POST['product_name'],
                'price' => $_POST['price'],
                'quantity' => $_POST['quantity'],
                'description' => $_POST['description']
            );
            
            if ($productController->updateProduct($product_id, $data)) {
                header("Location: index.php?update_success=1");
                exit;
            } else {
                echo "Failed to update product.";
            }
        }
    } else {
        $message = "Product not found."; 
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <link rel="stylesheet" href="style/styles.css">
</head>
<body>
    <div class="container">
        <h2>Update Product</h2>
        <?php if(isset($_GET['update_success']) && $_GET['update_success'] == 1) : ?>
            <div class="notification">
                Product updated successfully.
            </div>
        <?php endif; ?>
        <?php if(!empty($message)) echo $message; ?> 
        <?php if($productDetails) : ?>
        <form action="" method="post">
            <input type="hidden" name="id" value="<?php echo $productDetails['id']; ?>">
            <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name" value="<?php echo $productDetails['product_name']; ?>">
            
            <label for="price">Price:</label>
            <input type="text" id="price" name="price" value="<?php echo $productDetails['price']; ?>">
            
            <label for="quantity">Quantity:</label>
            <input type="text" id="quantity" name="quantity" value="<?php echo $productDetails['quantity']; ?>">
            
            <label for="description">Description:</label>
            <textarea id="description" name="description"><?php echo $productDetails['description']; ?></textarea>
            
            <input type="submit" value="Update">
        </form>
        <?php endif; ?>
    </div>
</body>
</html>
