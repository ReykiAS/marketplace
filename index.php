<?php
include 'Config/init.php';
include PROJECT_ROOT . '/Controller/ProductController.php';
$controller = new ProductController();

$products = $controller->getAllProducts();

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['selected_products'])) {
    $controller = new ProductController();
    $ids = $_POST['selected_products'];
    if ($controller->MultipleSoftDeleteProducts($ids)) {
        header("Location: index.php?soft_delete_success=1");
        exit;
    } else {
        echo "Failed to delete products.";
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['selected_products'])) {
    $message = "No products selected for deletion."; 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link rel="stylesheet" href="style/styles.css">
</head>
<body>
    <h2>Product List</h2>
    <a href="<?php echo BASE_URL . "/create.php"?>">Add Product</a>
    <a href="<?php echo BASE_URL . "/recovery.php"?>">Recovery Data</a>
    <?php if (!empty($message)) : ?> 
        <p><?php echo $message; ?></p>
    <?php endif; ?>
    
    <br><br>
    <form action="" method="post" id="deleteForm">
        <table>
            <tr>
                <th>No</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total Price</th> 
                <th>Description</th>
                <th>Action</th>
                <th>Select</th>
            </tr>
            <?php if (is_array($products) && count($products) > 0) : ?>
                <?php $counter = 1 ?>
                <?php foreach ($products as $product) : ?>
                    <tr class="active-row">
                        <td><?php echo $counter ?></td>
                        <td><?php echo $product["product_name"] ?></td>
                        <td><?php echo $product["price"] ?></td>
                        <td><?php echo $product["quantity"] ?></td>
                        <td><?php echo number_format($product['price'] * $product['quantity'], 0, '.', ',') ?></td> 
                        <td><?php echo $product["description"] ?></td>
                        
                        <td>
                            <a href="detail.php?id=<?php echo $product['id']; ?>">View</a> |
                            <a href="update.php?id=<?php echo $product['id']; ?>">Update</a> |
                            <a href="delete.php?id=<?php echo $product['id']; ?>" class="delete-link">Delete</a>
                        </td>

                        <td>
                            <input type="checkbox" name="selected_products[]" value="<?php echo $product['id'] ?>">
                        </td>
                    </tr>
                    <?php $counter++ ?>
                <?php endforeach ?>
                <tr>
                    <td colspan="8"> 
                    <button type="button" class="delete-button" onclick="confirmDelete()">Delete Selected Products</button>
                    </td>
                </tr>
            <?php elseif ($products === false) : ?>
                <tr>
                    <td colspan="8">Error retrieving products.</td> 
                </tr>
            <?php else : ?>
                <tr>
                    <td colspan="8">0 result</td> 
                </tr>
            <?php endif ?>
        </table>
    </form>
    <script>
        function confirmDelete() {
            if (confirm("Are you sure you want to delete the selected products?")) {
                if (confirm("Do you want to delete the selected product(s)?")) {
                    document.getElementById("deleteForm").submit();
                }
            }
        }
    </script>

</body>
</html>
