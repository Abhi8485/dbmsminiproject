
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $conn = new mysqli('localhost', 'root', '', 'inventory_management_db');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    
    $stmt = $conn->prepare("INSERT INTO products (id, name, price, quantity) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssdi", $id, $name, $price, $quantity); 
    if ($stmt->execute()) {
        echo "Product added successfully";
    } else {
        echo "Error adding product: " . $stmt->error;
    }

    
    $stmt->close();
    $conn->close();
} else {
    
    echo "Invalid request method";
}
?>
