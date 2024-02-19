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
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        h2 {
            margin-top: 0;
        }
        p {
            margin: 5px 0;
        }
        .back-link:hover {
            text-decoration: underline;
        }
        .back-link {
            display: block;
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
            padding: 10px 20px;
            border-radius: 4px;
            text-align: center;
            margin-top: 20px;
        }
    </style>
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
