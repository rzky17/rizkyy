<?php
include 'config.php';
$id = $_GET['id'];

$sql = "SELECT image FROM barang WHERE id='$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
unlink('uploads/' . $row['image']);

$conn->query("DELETE FROM barang WHERE id='$id'");
header('Location: index.php');
exit();
?>
