<?php
include 'db.php'; 

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID tidak valid!");
}

$id = intval($_GET['id']); 
$data = $conn->query("SELECT * FROM aksesoris WHERE Id_aksesoris = $id")->fetch_assoc();

if (!$data) {
    die("Data aksesoris tidak ditemukan!");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_aksesoris = $conn->real_escape_string($_POST['nama_aksesoris']);
    $satuan = $conn->real_escape_string($_POST['satuan']);
    $harga_beli = floatval($_POST['harga_beli']);
    $harga_jual = floatval($_POST['harga_jual']);
    $jumlah_stok = intval($_POST['jumlah_stok']);
    $user_name = $conn->real_escape_string($_POST['user_name']);
    $tgl_input = $conn->real_escape_string($_POST['tgl_input']);

    $stmt = $conn->prepare("UPDATE aksesoris SET 
        Nama_aksesoris = ?, 
        Satuan = ?, 
        Harga_beli = ?, 
        Harga_jual = ?, 
        Jumlah_stok = ?, 
        User_name = ?, 
        Tgl_input = ? 
        WHERE Id_aksesoris = ?");
    $stmt->bind_param("ssddiisi", $nama_aksesoris, $satuan, $harga_beli, $harga_jual, $jumlah_stok, $user_name, $tgl_input, $id);

    if ($stmt->execute()) {
        header("Location: index.php"); 
        exit();
    } else {
        die("Gagal mengupdate data: " . $stmt->error);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Aksesoris</title>
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>
    <h1>Edit Aksesoris</h1>
    <form action="" method="post">
        <label>Nama Aksesoris: 
            <input type="text" name="nama_aksesoris" value="<?= htmlspecialchars($data['Nama_aksesoris']) ?>" required>
        </label><br>
        <label>Satuan: 
            <input type="text" name="satuan" value="<?= htmlspecialchars($data['Satuan']) ?>" required>
        </label><br>
        <label>Harga Beli: 
            <input type="number" name="harga_beli" value="<?= htmlspecialchars($data['Harga_beli']) ?>" step="0.01" required>
        </label><br>
        <label>Harga Jual: 
            <input type="number" name="harga_jual" value="<?= htmlspecialchars($data['Harga_jual']) ?>" step="0.01" required>
        </label><br>
        <label>Jumlah Stok: 
            <input type="number" name="jumlah_stok" value="<?= htmlspecialchars($data['Jumlah_stok']) ?>" required>
        </label><br>
        <label>User Name: 
            <input type="text" name="user_name" value="<?= htmlspecialchars($data['User_name']) ?>" required>
        </label><br>
        <label>Tanggal Input: 
            <input type="date" name="tgl_input" value="<?= htmlspecialchars($data['Tgl_input']) ?>" required>
        </label><br>
        <button type="submit">Simpan</button>
    </form>
</body>
</html>
