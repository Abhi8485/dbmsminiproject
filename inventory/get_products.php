<?php

$conn = new mysqli('localhost', 'root', '', 'inventory_management_db');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['price']}</td>
                <td>{$row['quantity']}</td>
                <td>
                    <button onclick='deleteProduct({$row['id']})'>Delete</button>
                    <button onclick='showUpdateForm({$row['id']}, \"{$row['name']}\", {$row['price']}, {$row['quantity']})'>Update</button>
                </td>
            </tr>";
    }
} else {
    echo "<tr><td colspan='5'>No products found</td></tr>";
}

$conn->close();
?>
