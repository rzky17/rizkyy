<!DOCTYPE html>
<html>
<head>
    <title>Product CRUD</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <h1>Product CRUD</h1>

    <form action="process.php" method="post">
        <input type="hidden" name="id">
        <label for="name">Name:</label>
        <input type="text" name="name" required><br><br>
        <label for="price">Price:</label>
        <input type="number" name="price" required><br><br>
        <label for="image">Image URL:</label>
        <input type="text" name="image"><br><br>
        <label for="description">Description:</label>
        <textarea name="description" rows="4" cols="50"></textarea><br><br>
        <input type="submit" name="submit" value="Submit">
    </form>

    <br><br>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Image</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
        <?php
        require_once 'koneksi.php';
        require_once 'functions.php';

        $result = getAllProducts();
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['price'] . "</td>";
            echo "<td><img src='" . $row['image'] . "' width='100'></td>";
            echo "<td>" . $row['description'] . "</td>";
            echo "<td><a href='edit.php?id=" . $row['id'] . "'>Edit</a> | <a href='delete.php?id=" . $row['id'] . "'>Delete</a></td>";
            echo "</tr>";
        }
        ?>
    </table>

</body>
</html>