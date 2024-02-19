<?php
include 'Config/init.php';
include PROJECT_ROOT . '/Controller/ProductController.php';

$productController = new ProductController();

// Check if product ID is provided
if(isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Check if delete button is pressed
    if(isset($_POST['delete_product'])) {
        $success = $productController->softDeleteProduct($product_id);
        if ($success) {
            echo "Product successfully marked as deleted.";
            header("Location: index.php");
            exit; 
        } 
    }

    $productDetails = $productController->viewProductDetails($product_id);
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
        <?php if(isset($productDetails)) : ?>
            <p>ID: <?php echo $productDetails['id']; ?></p>
            <p>Name: <?php echo $productDetails['product_name']; ?></p>
            <p>Price: <?php echo $productDetails['price']; ?></p>
            <p>Quantity: <?php echo $productDetails['quantity']; ?></p>
            <p>Description: <?php echo $productDetails['description']; ?></p>

            <form action='' method='post' class='delete-form' onsubmit='return confirmDelete()'>
                <input type='hidden' name='product_id' value='<?php echo $product_id; ?>'>
                <input type='submit' name='delete_product' value='Delete'>
            </form>

            <script>
                function confirmDelete() {
                    return confirm('Are you sure you want to delete this product?');
                }
            </script>

            <a href='index.php' class='back-link'>Back to Homepage</a>
        <?php else : ?>
            <p>No product details found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
