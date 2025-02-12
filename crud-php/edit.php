<?php 
include 'config.php'; 
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM barang WHERE id='$id'");
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Barang</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Edit Barang</h2>
        <form action="process.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="action" value="edit">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <div class="mb-3">
                <label>Nama Barang:</label>
                <input type="text" name="nama_barang" class="form-control" value="<?= $row['nama_barang'] ?>" required>
            </div>
            <div class="mb-3">
                <label>Harga:</label>
                <input type="number" name="harga" class="form-control" value="<?= $row['harga'] ?>" required>
            </div>
            <div class="mb-3">
                <label>Gambar Baru (Opsional):</label>
                <input type="file" name="image" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="index.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>
