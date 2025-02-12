<?php
include 'config.php';

if ($_POST['action'] == 'add') {
    $nama_barang = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];

    move_uploaded_file($image_tmp, 'uploads/' . $image_name);
    $conn->query("INSERT INTO barang (nama_barang, harga, image) VALUES ('$nama_barang', '$harga', '$image_name')");
}

if ($_POST['action'] == 'edit') {
    $id = $_POST['id'];
    $nama_barang = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];

    if ($image_name) {
        $sql = "SELECT image FROM barang WHERE id='$id'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        unlink('uploads/' . $row['image']);

        move_uploaded_file($image_tmp, 'uploads/' . $image_name);
        $conn->query("UPDATE barang SET nama_barang='$nama_barang', harga='$harga', image='$image_name' WHERE id='$id'");
    } else {
        $conn->query("UPDATE barang SET nama_barang='$nama_barang', harga='$harga' WHERE id='$id'");
    }
}

header('Location: index.php');
exit();
?>
