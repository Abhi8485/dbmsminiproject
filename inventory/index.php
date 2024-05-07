<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Inventory Management System</h1>

    <h2>Add Product</h2>
    <form id="addProductForm">
        <input type="text" name="id" id="productId" placeholder="Product ID" required>
        <input type="text" name="name" id="productName" placeholder="Product Name" required>
        <input type="number" name="price" id="productPrice" placeholder="Price" step="0.01" required>
        <input type="number" name="quantity" id="productQuantity" placeholder="Quantity" required>
        <button type="button" onclick="addProduct()">Add Product</button>
    </form>

    <h2>Products in Inventory</h2>
    <table id="productTable">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Actions</th>
        </tr>
        <!-- Product list will be dynamically updated here -->
    </table>

    <!-- Update Product Form (hidden by default) -->
    <div id="updateForm" style="display: none;">
        <h2>Update Product</h2>
        <form id="updateProductForm">
            <input type="hidden" name="id" id="updateId">
            <input type="text" name="name" id="updateName" required>
            <input type="number" name="price" id="updatePrice" step="0.01" required>
            <input type="number" name="quantity" id="updateQuantity" required>
            <button type="button" onclick="updateProduct()">Update Product</button>
            <button type="button" onclick="hideUpdateForm()">Cancel</button>
        </form>
    </div>

    <script>
        function addProduct() {
            var productId = document.getElementById('productId').value;
            var productName = document.getElementById('productName').value;
            var productPrice = document.getElementById('productPrice').value;
            var productQuantity = document.getElementById('productQuantity').value;

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        alert('Product added successfully');
                        updateProductList();
                        document.getElementById('addProductForm').reset();
                    } else {
                        alert('Error adding product');
                    }
                }
            };

            xhr.open('POST', 'add_product.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.send('id=' + encodeURIComponent(productId) + '&name=' + encodeURIComponent(productName) + '&price=' + encodeURIComponent(productPrice) + '&quantity=' + encodeURIComponent(productQuantity));
        }

        function updateProductList() {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        document.getElementById('productTable').innerHTML = xhr.responseText;
                    } else {
                        alert('Error fetching product list');
                    }
                }
            };

            xhr.open('GET', 'get_products.php', true);
            xhr.send();
        }

        function deleteProduct(id) {
            if (confirm('Are you sure you want to delete this product?')) {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            alert('Product deleted successfully');
                            updateProductList();
                        } else {
                            alert('Error deleting product');
                        }
                    }
                };

                xhr.open('GET', 'delete_product.php?id=' + id, true);
                xhr.send();
            }
        }

        function updateProduct() {
            var id = document.getElementById('updateId').value;
            var name = document.getElementById('updateName').value;
            var price = document.getElementById('updatePrice').value;
            var quantity = document.getElementById('updateQuantity').value;

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        alert('Product updated successfully');
                        updateProductList();
                        hideUpdateForm();
                    } else {
                        alert('Error updating product');
                    }
                }
            };

            xhr.open('POST', 'update_product.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.send('id=' + id + '&name=' + encodeURIComponent(name) + '&price=' + encodeURIComponent(price) + '&quantity=' + encodeURIComponent(quantity));
        }

        function showUpdateForm(id, name, price, quantity) {
            document.getElementById('updateId').value = id;
            document.getElementById('updateName').value = name;
            document.getElementById('updatePrice').value = price;
            document.getElementById('updateQuantity').value = quantity;
            document.getElementById('updateForm').style.display = 'block';
        }

        function hideUpdateForm() {
            document.getElementById('updateForm').style.display = 'none';
        }

        
        updateProductList();
    </script>
</body>
</html>
