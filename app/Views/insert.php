<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert New Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }
        h1 {
            color: #333;
            margin-bottom: 20px;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            margin: 0 auto;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            padding: 10px 20px;
        }
        input[type="submit"]:hover {
            background-color: #2980b9;
        }
        button[type="button"] {
            background-color: #e74c3c;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            padding: 10px 20px;
            margin-right: 10px;
        }
        button[type="button"]:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>

<h1>Insert New Product</h1>

<form action="/insert" method="post">
    <!-- Form fields for product details (Name, Description, Category, Price, Quantity) -->
    <label>Product Name:</label>
    <input type="text" name="Name">
    
    <label>Description:</label>
    <input type="text" name="Description">
    
    <label>Category:</label>
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
        $sql = "SELECT id, Category FROM table_category";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . $row['Category'] . "</option>";
            }
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>
    </select>

    <label>Price:</label>
    <input type="text" name="Price">
    
    <label>Quantity:</label>
    <input type="text" name="Quantity">

    <input type="submit" value="Add Product">
    <!-- Cancel button (go back to the previous page) -->
    <button type="button" onclick="window.history.back();">Cancel</button>

</form>

</body>
</html>
