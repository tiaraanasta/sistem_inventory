<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION['user'])) header("Location: login.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Stok Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <div class="container">
        <h3>Daftar Stok Barang</h3>
        <table class="table table-bordered table-hover mt-3">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Supplier</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $res = mysqli_query($conn, "SELECT b.*, s.namaSupplier FROM barang b JOIN supplier s ON b.idSupplier = s.idSupplier");
                while($row = mysqli_fetch_assoc($res)) : ?>
                <tr>
                    <td><?= $row['idBarang']; ?></td>
                    <td><?= $row['namaBarang']; ?></td>
                    <td>Rp <?= number_format($row['harga']); ?></td>
                    <td class="<?= $row['stok'] < 5 ? 'text-danger fw-bold' : '' ?>"><?= $row['stok']; ?></td>
                    <td><?= $row['namaSupplier']; ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </div>
</body>
</html>