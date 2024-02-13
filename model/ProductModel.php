<?php
class ProductModel {
    private $id;
    private $product_name;
    private $price;
    private $quantity;
    private $description;

    public function __construct($id, $product_name, $price, $quantity, $description) {
        $this->id = $id;
        $this->product_name = $product_name;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->description = $description;
    }

    // Getters and setters if needed
}
?>
