<?php
session_start();
include 'koneksi.php';
if ($_SESSION['role'] != 'Owner') header("Location: index.php");

// Tambah Barang (BarangService::tambahBarang)
if (isset($_POST['simpan'])) {
    $id = $_POST['idBarang'];
    $nama = $_POST['namaBarang'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $idSup = $_POST['idSupplier'];

    mysqli_query($conn, "INSERT INTO barang VALUES ('$id', '$nama', '$harga', '$stok', '$idSup')");
    header("Location: kelola_barang.php");
}
?>
<!DOCTYPE html>
<html>
<head><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="p-4">
    <h3>🛠 Kelola Barang</h3>
    <form method="POST" class="row g-2 mb-4">
        <div class="col-md-2"><input type="text" name="idBarang" class="form-control" placeholder="ID Barang" required></div>
        <div class="col-md-3"><input type="text" name="namaBarang" class="form-control" placeholder="Nama Barang" required></div>
        <div class="col-md-2"><input type="number" name="harga" class="form-control" placeholder="Harga" required></div>
        <div class="col-md-2"><input type="number" name="stok" class="form-control" placeholder="Stok" required></div>
        <div class="col-md-2">
            <select name="idSupplier" class="form-select">
                <?php
                $sup = mysqli_query($conn, "SELECT * FROM supplier");
                while($s = mysqli_fetch_assoc($sup)) echo "<option value='".$s['idSupplier']."'>".$s['namaSupplier']."</option>";
                ?>
            </select>
        </div>
        <div class="col-md-1"><button type="submit" name="simpan" class="btn btn-success">Simpan</button></div>
    </form>

    <table class="table table-bordered">
        <thead class="table-dark text-center">
            <tr><th>ID</th><th>Nama Barang</th><th>Harga</th><th>Stok</th><th>Supplier</th></tr>
        </thead>
        <tbody>
            <?php
            $res = mysqli_query($conn, "SELECT b.*, s.namaSupplier FROM barang b JOIN supplier s ON b.idSupplier = s.idSupplier");
            while($row = mysqli_fetch_assoc($res)) : ?>
            <tr>
                <td><?= $row['idBarang'] ?></td>
                <td><?= $row['namaBarang'] ?></td>
                <td>Rp <?= number_format($row['harga']) ?></td>
                <td><?= $row['stok'] ?></td>
                <td><?= $row['namaSupplier'] ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <a href="index.php" class="btn btn-secondary">Kembali</a>
</body>
</html>