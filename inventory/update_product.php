<?php

$conn = new mysqli('localhost', 'root', '', 'inventory_management_db');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_POST['id'], $_POST['name'], $_POST['price'], $_POST['quantity'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    
    $sql = "UPDATE products SET name = '$name', price = $price, quantity = $quantity WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "Product updated successfully";
    } else {
        echo "Error updating product: " . $conn->error;
    }
} else {
    echo "Form data not provided";
}


$conn->close();
?>
