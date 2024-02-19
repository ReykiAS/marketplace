<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = 'marketplace';

$conn = new mysqli ($servername, $username, $password, $dbname);
if ($conn->connect_error){
    die("koneksi Gagal:" .$conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $productName = $_POST["product_name"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];

    $sql = "INSERT INTO products (product_name, price, quantity) VALUES ('$productName', '$price','$quantity')";
if ($conn->query($sql) === TRUE){
    echo "Produk berhasil ditambahkan ke dalam market place!\n";
    echo "Informasi Produk:\n";
    echo " Nama Produk : $productName\n";
    echo "Harga : $price\n";
    echo "stok: $quantity\n";
}else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
    

} else{
    echo "Akses Tidak Sah !";
}
$conn->close();
?>