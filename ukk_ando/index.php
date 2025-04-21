You said:
<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "dbtoko";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if (isset($_GET['hapus'])) {
    $id_aksesoris = intval($_GET['hapus']);
    $stmt = $conn->prepare("DELETE FROM aksesoris WHERE Id_aksesoris = ?");
    $stmt->bind_param("i", $id_aksesoris);
    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Gagal menghapus data: " . $stmt->error;
    }
    $stmt->close();
}

if (isset($_POST['tambah'])) {
    $nama_aksesoris = $conn->real_escape_string($_POST['nama_aksesoris']);
    $satuan = $conn->real_escape_string($_POST['satuan']);
    $harga_beli = floatval($_POST['harga_beli']);
    $harga_jual = floatval($_POST['harga_jual']);
    $jumlah_stok = intval($_POST['jumlah_stok']);
    $user_name = $conn->real_escape_string($_POST['user_name']);
    $tgl_input = $conn->real_escape_string($_POST['tgl_input']);

    $stmt = $conn->prepare("INSERT INTO aksesoris (Nama_aksesoris, Satuan, Harga_beli, Harga_jual, Jumlah_stok, User_name, Tgl_input) 
                            VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssddiss", $nama_aksesoris, $satuan, $harga_beli, $harga_jual, $jumlah_stok, $user_name, $tgl_input);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Gagal menambahkan data: " . $stmt->error;
    }
    $stmt->close();
}

$aksesoris = $conn->query("SELECT * FROM aksesoris");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Aksesoris</title>
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>
    <h1>Daftar Aksesoris</h1>

    <form method="POST" action="">
        <h3>Tambah Aksesoris</h3>
        <label>Nama Aksesoris:</label><br>
        <input type="text" name="nama_aksesoris" required><br>
        <label>Satuan:</label><br>
        <input type="text" name="satuan" required><br>
        <label>Harga Beli:</label><br>
        <input type="number" name="harga_beli" step="0.01" required><br>
        <label>Harga Jual:</label><br>
        <input type="number" name="harga_jual" step="0.01" required><br>
        <label>Jumlah Stok:</label><br>
        <input type="number" name="jumlah_stok" required><br>
        <label>User Name:</label><br>
        <input type="text" name="user_name" required><br>
        <label>Tanggal Input:</label><br>
        <input type="date" name="tgl_input" required><br><br>
        <button type="submit" name="tambah">Tambah</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama barang</th>
                <th>kategori barang</th>
                <th>jumlah stok</th>
                <th>Harga barang</th>
                <th>Jumlah Stok</th>
                <th>user name</th>
                <th>Tanggal Input</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $aksesoris->fetch_assoc()) : ?>
                <tr>
                    <td><?= htmlspecialchars($row['Id_aksesoris']) ?></td>
                    <td><?= htmlspecialchars($row['Nama_aksesoris']) ?></td>
                    <td><?= htmlspecialchars($row['Satuan']) ?></td>
                    <td><?= htmlspecialchars($row['Harga_beli']) ?></td>
                    <td><?= htmlspecialchars($row['Harga_jual']) ?></td>
                    <td><?= htmlspecialchars($row['Jumlah_stok']) ?></td>
                    <td><?= htmlspecialchars($row['User_name']) ?></td>
                    <td><?= htmlspecialchars($row['Tgl_input']) ?></td>
                    <td>
                        <a href="edit.php?id=<?= $row['Id_aksesoris'] ?>">Edit</a> |
                        <a href="index.php?hapus=<?= $row['Id_aksesoris'] ?>" onclick="return confirm('Hapus data ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>