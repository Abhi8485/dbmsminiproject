<?php

$conn = new mysqli('localhost', 'root', '', 'inventory_management_db');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $products = array();
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    echo json_encode($products); // Output products as JSON
} else {
    echo "No products found";
}


$conn->close();
?>
