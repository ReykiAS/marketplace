<?php
include('database/database.php');
include('model/ProductModel.php');

$productModel = new ProductModel();
$products = $productModel->getAllProducts(); // Assuming getAllProducts() retrieves products from the database

?>

<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>
</head>
<body>
    <h1>Product List</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Description</th>
            <th>Total Price</th>
            <th>Action</th>
        </tr>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?php echo $product['id']; ?></td>
                <td><?php echo $product['product_name']; ?></td>
                <td><?php echo $product['price']; ?></td>
                <td><?php echo $product['quantity']; ?></td>
                <td><?php echo $product['description']; ?></td>
                <td><?php echo $product['price'] * $product['quantity']; ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $product['id']; ?>">Edit</a>
                    <a href="delete.php?id=<?php echo $product['id']; ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <!-- Form for creating a new product -->
    <form action="create.php" method="post">
        <label for="product_name">Product Name:</label>
        <input type="text" name="product_name" id="product_name">
        <label for="price">Price:</label>
        <input type="text" name="price" id="price">
        <label for="quantity">Quantity:</label>
        <input type="text" name="quantity" id="quantity">
        <label for="description">Description:</label>
        <textarea name="description" id="description"></textarea>
        <input type="submit" value="Create Product">
    </form>
</body>
</html>
