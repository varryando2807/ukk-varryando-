<?php
include 'db.php'; 

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID tidak valid!"); 
}

$id = intval($_GET['id']); 

if ($conn->query("DELETE FROM produk WHERE id = $id") === TRUE) {
    header("Location: index.php"); 
    exit();
} else {
    die("Gagal menghapus data: " . $conn->error); }
?>