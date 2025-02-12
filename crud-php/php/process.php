<?php

require_once 'koneksi.php';
require_once 'function.php';

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $description = $_POST['description'];

    if (empty($id)) {
        createProduct($name, $price, $image, $description);
    } else {
        updateProduct($id, $name, $price, $image, $description);
    }

    header("Location: index.php");
    exit();
}

?>