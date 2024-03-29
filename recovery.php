<?php
include 'Config/init.php';
include PROJECT_ROOT . '/Controller/ProductController.php';
$controller = new ProductController();
$products = $controller->getAllProducts( $deleted=1);

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['selected_products'])) {
    $productController = new ProductController();
    $ids = $_POST['selected_products'];
    if ($productController->recovery($ids)) {
        header("Location: index.php?recovery_data_success=1");
        exit;
    } else {
        echo "Failed to recovery products.";
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['selected_products'])) {
    $message = "No products selected for recovery."; 
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
    <?php if (!empty($message)) : ?> 
        <p><?php echo $message; ?></p>
    <?php endif; ?>
    <a href="index.php" class=""> Back to Homepage</a>
    <br><br>
    <form action="" method="post">
        <table>
            <tr>
                <th>No</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Description</th>
                <th>Select</th>
            </tr>
            <?php if (count($products) > 0) : ?>
                <?php $counter = 1 ?>
                <?php foreach ($products as $product) : ?>
                    <tr>
                        <td><?php echo $counter ?></td>
                        <td><?php echo $product["product_name"] ?></td>
                        <td><?php echo $product["price"] ?></td>
                        <td><?php echo $product["quantity"] ?></td>
                        <td><?php echo $product["description"] ?></td>
                        <td>
                            <input type="checkbox" name="selected_products[]" value="<?php echo $product['id'] ?>">
                        </td>
                    </tr>
                    <?php $counter++ ?>
                <?php endforeach ?>
                <tr>
                    <td colspan="7">
                        <button type="submit" class="delete-button">Recovery Products</button>
                    </td>
                </tr>
            <?php else : ?>
                <tr>
                    <td colspan="7">0 result</td>
                </tr>
            <?php endif ?>
        </table>
    </form>
</body>
</html>
