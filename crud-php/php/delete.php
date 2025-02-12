<?php

require_once 'koneksi.php';
require_once 'function.php';

$id = $_GET['id'];
deleteProduct($id);
header("Location: index.php");
exit();

?>