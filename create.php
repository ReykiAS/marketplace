<?php
include 'Config/init.php';
include PROJECT_ROOT . '/Controller/ProductController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productController = new ProductController();
    $data = array(
        'product_name' => $_POST['product_name'],
        'price' => $_POST['price'],
        'quantity' => $_POST['quantity'],
        'description' => $_POST['description']
    );
    if ($productController->addProduct($data)) {
        echo "Product added successfully.";
        // Redirect to index.php
        header("Location: index.php");
        exit();
    } else {
        echo "Failed to add product.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            margin-bottom: 20px;
        }
        form {
            max-width: 400px;
            margin: 0 auto;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
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
    </style>
</head>
<body>
    <h1>Add Product</h1>
    <form method="post" action="">
        <label for="product_name">Product Name:</label>
        <input type="text" id="product_name" name="product_name">
        
        <label for="price">Price:</label>
        <input type="text" id="price" name="price">
        
        <label for="quantity">Quantity:</label>
        <input type="text" id="quantity" name="quantity">
        
        <label for="description">Description:</label>
        <textarea id="description" name="description"></textarea>
        
        <input type="submit" value="Submit">
    </form>
</body>
</html>
