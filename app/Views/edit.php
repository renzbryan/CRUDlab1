<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        h1 {
            margin-bottom: 20px;
            color: #333;
        }
        form {
            max-width: 400px;
            width: 100%;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            font-weight: bold;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #2980b9;
        }
        button[type="button"] {
            background-color: #e74c3c;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-right: 10px;
        }
        button[type="button"]:hover {
            background-color: #c0392b;
        }

    </style>
</head>
<body>
<h1>Edit Product</h1>
<form action="<?= base_url('/update') ?>" method="post">
    <input type="hidden" name="id" value="<?= isset($p['id']) ? $p['id'] : '' ?>">
    <label> Product Name: </label>
    <input type="text" name="Name" value="<?= isset($p['Name']) ? $p['Name'] : '' ?>">
    <label> Description: </label>
    <input type="text" name="Description" value="<?= isset($p['Description']) ? $p['Description'] : '' ?>">
    <label> Category: </label>
    <select name="Category">
        <?php
        // Establish a database connection (replace with your credentials)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "product_listing";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch categories from the table_category
        $categoryResult = $conn->query("SELECT id, Category FROM table_category");

        if ($categoryResult->num_rows > 0) {
            while ($category = $categoryResult->fetch_assoc()) {
                $categoryId = $category['id'];
                $categoryName = $category['Category'];

                // Check if the category is selected for the product being edited
                $selected = (isset($p['Category']) && $p['Category'] == $categoryId) ? 'selected' : '';

                echo "<option value='$categoryId' $selected>$categoryName</option>";
            }
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>
    </select>

    <label> Price: </label>
    <input type="text" name="Price" value="<?= isset($p['Price']) ? $p['Price'] : '' ?>">
    <label> Quantity: </label>
    <input type="text" name="Quantity" value="<?= isset($p['Quantity']) ? $p['Quantity'] : '' ?>">
    <br><br>
    <input type="submit" name="update" value="Update">
    <!-- Delete button -->
    <button type="button" onclick="confirmDelete(<?= isset($p['id']) ? $p['id'] : '' ?>)">Delete</button>
    
    <button type="button" onclick="window.history.back();" style="background-color: #95a5a6;">Cancel</button>
</form>

<script>
    function confirmDelete(id) {
        if (id !== '') {
            if (confirm('Are you sure you want to delete this product?')) {
                window.location.href = '<?= base_url('/delete/') ?>' + id;
            }
        } else {
            alert('Product ID is not available.');
        }
    }
</script>

</body>
</html>
