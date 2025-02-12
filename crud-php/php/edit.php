<?php

require_once 'koneksi.php';
require_once 'function.php';

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");
$row = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
</head>
<body>
    <h1>Edit Product</h1>

    <form action="process.php" method="post">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo $row['name']; ?>" required><br><br>
        <label for="price">Price:</label>
        <input type="number" name="price" value="<?php echo $row['price']; ?>" required><br><br>
        <label for="image">Image URL:</label>
        <input type="text" name="image" value="<?php echo $row['image']; ?>"><br><br>
        <label for="description">Description:</label>
        <textarea name="description" rows="4" cols="50"><?php echo $row['description']; ?></textarea><br><br>
        <input type="submit" name="submit" value="Update">
    </form>

</body>
</html>