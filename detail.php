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
        .back-link {
            display: block;
            margin-top: 20px;
            text-decoration: none;
            color: #007bff;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        include 'Config/init.php';
        include PROJECT_ROOT . '/Controller/ProductController.php';
        $id = $_GET['id'];

        $productController = new ProductController();

        // Check if product ID is provided
        if(isset($_GET['id'])) {
            $id = $_GET['id'];

            // Get product details from controller
            $productDetails = $productController->viewProductDetails($id);

            // Display product details
            if($productDetails) {
                echo "<h2>Product Details</h2>";
                echo "<p>ID: " . $productDetails['id'] . "</p>";
                echo "<p>Product Name: " . $productDetails['product_name'] . "</p>";
                echo "<p>Price: $" . $productDetails['price'] . "</p>";
                echo "<p>Quantity: " . $productDetails['quantity'] . "</p>";
                echo "<p>Description: " . $productDetails['description'] . "</p>";
            } else {
                echo "Product not found.";
            }
        } else {
            echo "No product ID provided.";
        }
        ?>
        <a href="index.php" class="back-link">&lt; Back to Homepage</a>
    </div>
</body>
</html>