<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'barang_db';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$sql = "CREATE TABLE IF NOT EXISTS barang (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_barang VARCHAR(255) NOT NULL,
    harga INT NOT NULL,
    image VARCHAR(255) NOT NULL
)";
$conn->query($sql);
?>
