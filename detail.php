<?php
include 'Config/init.php';
include PROJECT_ROOT . '/Controller/ProductController.php';

$id = $_GET['id'] ?? null;

$productController = new ProductController();

if($id !== null) {
    $productDetails = $productController->viewProductDetails($id);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link rel="stylesheet" href="style/styles.css">

</head>
<body>
    <div class="container">
        <h2>Product Details</h2>
        <p>ID: <?php echo $productDetails['id']; ?></p>
        <p>Name: <?php echo $productDetails['product_name']; ?></p>
        <p>Price: <?php echo $productDetails['price']; ?></p>
        <p>Quantity: <?php echo $productDetails['quantity']; ?></p>
        <p>Description : <?php echo $productDetails['description']; ?></p>
        <a href="index.php" class="back-link"> Back to Homepage</a>
    </div>
</body>
</html>
