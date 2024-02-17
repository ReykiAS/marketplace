<?php
include 'Config/init.php';
include PROJECT_ROOT . '/Controller/ProductController.php';

$productController = new ProductController();

// Check if product ID is provided in the URL
if(isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Get product details from the controller
    $productDetails = $productController->viewProductDetails($product_id);

    // Check if product details are retrieved successfully
    if($productDetails) {

        // Check if form is submitted for update
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Prepare data for update
            $data = array(
                'product_name' => $_POST['product_name'],
                'price' => $_POST['price'],
                'quantity' => $_POST['quantity'],
                'description' => $_POST['description']
            );
            
            // Call updateProduct method to update the product
            if ($productController->updateProduct($product_id, $data)) {
                // Redirect to index.php with a success message
                header("Location: index.php?update_success=1");
                exit;
            } else {
                echo "Failed to update product.";
            }
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .container {
            width: 50%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h2 {
            margin-top: 0;
        }
        form {
            margin-top: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .notification {
            margin-top: 20px;
            padding: 10px;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
            color: #155724;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Update Product</h2>
        <?php if(isset($_GET['update_success']) && $_GET['update_success'] == 1) : ?>
            <div class="notification">
                Product updated successfully.
            </div>
        <?php endif; ?>
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
    </div>
</body>
</html>
<?php
    } else {
        echo "Product not found.";
    }
} else {
    echo "No product ID provided.";
}
?>
