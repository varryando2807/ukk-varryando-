<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $nama = trim($_POST['nama']);
    $kategori = trim($_POST['kategori']);
    $harga = filter_input(INPUT_POST, 'harga', FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
    $stok = filter_input(INPUT_POST, 'stok', FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
    $keterangan = trim($_POST['keterangan']);
    $tanggal_masuk = $_POST['tanggal_masuk'];
    $tanggal_keluar = $_POST['tanggal_keluar'];

    if (
        !empty($nama) && !empty($kategori) && !empty($keterangan) &&
        $harga && $stok && 
        strtotime($tanggal_masuk) <= strtotime($tanggal_keluar)
    ) {
        
        $stmt = $conn->prepare("INSERT INTO produk (nama, kategori, harga, stok, keterangan, tanggal_masuk, tanggal_keluar) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssissss", $nama, $kategori, $harga, $stok, $keterangan, $tanggal_masuk, $tanggal_keluar);

        if ($stmt->execute()) {
            echo "<script>alert('Produk berhasil ditambahkan!'); window.location.href = 'index.php';</script>";
            exit;
        } else {
            echo "Terjadi kesalahan saat menyimpan data: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Input tidak valid. Pastikan semua kolom terisi dengan benar, harga dan stok lebih dari 0, serta tanggal masuk <= tanggal keluar.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <section>
        <h2>Tambah Produk</h2>
        <form action="" method="post">
            <label>Nama: <input type="text" name="nama" required></label><br>
            <label>Kategori: <input type="text" name="kategori" required></label><br>
            <label>Harga: <input type="number" name="harga" min="1" required></label><br>
            <label>Stok: <input type="number" name="stok" min="1" required></label><br>
            <label>Keterangan: <textarea name="keterangan" required></textarea></label><br>
            <label>Tanggal Masuk: <input type="date" name="tanggal_masuk" required></label><br>
            <label>Tanggal Keluar: <input type="date" name="tanggal_keluar" required></label><br>
            <button type="submit">Simpan</button>
        </form>
    </section>
</body>
</html>