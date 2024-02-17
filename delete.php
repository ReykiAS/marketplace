<?php
include 'Config/init.php';
include PROJECT_ROOT . '/Controller/ProductController.php';
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
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
        }

        p {
            margin: 0;
            padding: 5px 0;
        }

        .delete-form {
            margin-top: 20px;
        }

        .delete-form input[type="submit"] {
            background-color: #ff0000;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        .delete-form input[type="submit"]:hover {
            background-color: #cc0000;
        }

        .index-button {
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
        <?php
        // Initialize the controller
        $productController = new ProductController();

        // Check if product ID is provided
        if(isset($_GET['id'])) {
            $product_id = $_GET['id'];

            // Check if delete button is pressed
            if(isset($_POST['delete_product'])) {
                // Soft delete product
                $success = $productController->softDeleteProduct($product_id);
                if ($success) {
                    echo "Product successfully marked as deleted.";
                    // Redirect to index.php after successful deletion
                    header("Location: index.php");
                    exit; // Stop further execution
                } 
            }

            // Get product details from controller
            $productDetails = $productController->viewProductDetails($product_id);

            // Display product details
            if($productDetails) {
                echo "<h2>Product Details</h2>";
                echo "<p>ID: " . $productDetails['id'] . "</p>";
                echo "<p>Product Name: " . $productDetails['product_name'] . "</p>";
                echo "<p>Price: $" . $productDetails['price'] . "</p>";
                echo "<p>Quantity: " . $productDetails['quantity'] . "</p>";
                echo "<p>Description: " . $productDetails['description'] . "</p>";

                // Form for soft delete button with confirmation
                echo "<form action='' method='post' class='delete-form' onsubmit='return confirmDelete()'>";
                echo "<input type='hidden' name='product_id' value='" . $product_id . "'>";
                echo "<input type='submit' name='delete_product' value='Delete'>";
                echo "</form>";

                // JavaScript function for confirmation
                echo "<script>";
                echo "function confirmDelete() {";
                echo "    return confirm('Are you sure you want to delete this product?');";
                echo "}";
                echo "</script>";

                // Button to go to index.php
                echo "<a href='index.php' class='index-button'>Go to Products List</a>";
            } else {
                echo "Product not found.";
            }
        } else {
            echo "No product ID provided.";
        }
        ?>
    </div>
</body>
</html>
