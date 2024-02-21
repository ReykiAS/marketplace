<?php
include 'Config/init.php';
include PROJECT_ROOT . '/Controller/ProductController.php';

$messages = []; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['product_name']) || empty($_POST['price']) || empty($_POST['quantity'])) {
        $messages[] = "You must fill all the fields."; 
    } 
    if (!filter_var($_POST['price'], FILTER_VALIDATE_INT)) {
        $messages[] = "Price must be an integer value.";
    } 
    if (!filter_var($_POST['quantity'], FILTER_VALIDATE_INT)) {
        $messages[] = "Price must be an quantity value.";
    } 
    if (empty($messages)) {
        $productController = new ProductController();
        $data = array(
            'product_name' => $_POST['product_name'],
            'price' => $_POST['price'],
            'quantity' => $_POST['quantity'],
            'description' => $_POST['description']
        );
        
        if ($productController->addProduct($data)) {
            echo "Product added successfully.";
            header("Location: index.php");
            exit();
        } else {
            $messages[] = "Failed to add product.";
        }
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
        .messages {
            color: red;
            font-size: 13px;
        }
        
    </style>
</head>
<body>
<h1>Add Product</h1>
<a href="index.php" class="back-link"> Back to Homepage</a>
<form method="post" action="create.php">
    <label for="product_name">Product Name:
        <input type="text" id="product_name" name="product_name" value="<?php echo isset($_POST['product_name']) ? htmlspecialchars($_POST['product_name']) : ''; ?>">
        <?php if (!empty($messages) && in_array("You must fill all the fields.", $messages)) { ?>
            <span class="messages">You must fill the fields.</span>
        <?php } ?>
    </label>
    
    <label for="price">Price:
        <input type="text" id="price" name="price" value="<?php echo isset($_POST['price']) ? htmlspecialchars($_POST['price']) : ''; ?>">
        <?php if (!empty($messages) && in_array("Price must be an integer value.", $messages)) { ?>
            <span class="messages">Price must be an integer value.</span>
        <?php } ?>
    </label>
    
    <label for="quantity">Quantity:
        <input type="text" id="quantity" name="quantity" value="<?php echo isset($_POST['quantity']) ? htmlspecialchars($_POST['quantity']) : ''; ?>">
        <?php if (!empty($messages) && in_array("Price must be an quantity value.", $messages)) { ?>
            <span class="messages">Price must be an quantity value.</span>
        <?php } ?>
    </label>
    
    <label for="description">Description:
        <textarea id="description" name="description"><?php echo isset($_POST['description']) ? htmlspecialchars($_POST['description']) : ''; ?></textarea>
    </label>
    
    <input type="submit" value="Submit" name="submit">
    
</form>
</body>
</html>
