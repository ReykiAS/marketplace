
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Create Product</title>
    </head>
<body>
    <h2>Create Product</h2>
    <a href="../index.php">Back to Product List</a>
    <br><br>
    <form action="../Controller/create.php" method="post">
        <label for="product_name">Product Name:</label>
        <input type="text" name="product_name" required><br>
        <label for="price">Price:</label>
        <input type="text" name="price" required><br>
        <label for="quantity">Quantity:</label>
        <input type="text" name="quantity" required><br>
        <input type="submit" value="Add Product">
    </form>
</body>
</html>