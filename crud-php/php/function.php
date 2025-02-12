<?php

// Create
function createProduct($name, $price, $image, $description)
{
    global $conn;

    // Set the target directory for the image
    $target_dir = "uploads/";

    // Generate a unique filename for the image
    $target_file = $target_dir . basename($image["name"]);

    // Check if the image file is an actual image or a fake image
    $check = getimagesize($image["tmp_name"]);
    if ($check !== false) {
        // Image is valid, move it to the target directory
        if (move_uploaded_file($image["tmp_name"], $target_file)) {
            // Image uploaded successfully, insert the product into the database
            $sql = "INSERT INTO products (name, price, image, description) VALUES ('$name', '$price', '$target_file', '$description')";
            if (mysqli_query($conn, $sql)) {
                return true;
            } else {
                echo "Error: " . mysqli_error($conn);
                return false;
            }
        } else {
            
        }

// Read
function getAllProducts()
{
    global $conn;
    $sql = "SELECT * FROM products";
    $result = mysqli_query($conn, $sql);
    return $result;
}

// Update
function updateProduct($id, $name, $price, $image, $description)
{
    global $conn;
    $sql = "UPDATE products SET name='$name', price='$price', image='$image', description='$description' WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        echo "Error: " . mysqli_error($conn);
        return false;
    }
}

// Delete
function deleteProduct($id)
{
    global $conn;
    $sql = "DELETE FROM products WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        echo "Error: " . mysqli_error($conn);
        return false;
    }
}

?>