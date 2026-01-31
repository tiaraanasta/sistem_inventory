<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user'])) header("Location: login.php");

// 1. Logika Menambah Barang ke Keranjang (Session)
if (isset($_POST['tambah_keranjang'])) {
    $idBarang = $_POST['idBarang'];
    $jumlah = $_POST['jumlah'];

    $query = mysqli_query($conn, "SELECT * FROM barang WHERE idBarang='$idBarang'");
    $b = mysqli_fetch_assoc($query);

    if ($b['stok'] >= $jumlah) {
        $item = [
            'id' => $b['idBarang'],
            'nama' => $b['namaBarang'],
            'harga' => $b['harga'],
            'qty' => $jumlah,
            'subtotal' => $b['harga'] * $jumlah
        ];
        $_SESSION['keranjang'][] = $item;
    } else {
        echo "<script>alert('Stok tidak cukup!');</script> ";
    }
}

// 2. Logika Menghapus Keranjang
if (isset($_GET['hapus'])) {
    unset($_SESSION['keranjang'][$_GET['hapus']]);
    header("Location: transaksi.php");
}

// 3. Logika Simpan ke Database (Checkout)
if (isset($_POST['checkout'])) {
    if (!empty($_SESSION['keranjang'])) {
        $totalBayar = 0;
        foreach ($_SESSION['keranjang'] as $item) { $totalBayar += $item['subtotal']; }
        $namaKasir = $_SESSION['user'];

        // Simpan Header Transaksi
        mysqli_query($conn, "INSERT INTO transaksi (totalBayar, namaKasir) VALUES ('$totalBayar', '$namaKasir')");
        $idTransaksi = mysqli_insert_id($conn);

        // Simpan Detail & Update Stok
        foreach ($_SESSION['keranjang'] as $item) {
            $idB = $item['id'];
            $qty = $item['qty'];
            $sub = $item['subtotal'];

            mysqli_query($conn, "INSERT INTO detail_transaksi (idTransaksi, idBarang, jumlah, subtotal) VALUES ('$idTransaksi', '$idB', '$qty', '$sub')");
            mysqli_query($conn, "UPDATE barang SET stok = stok - $qty WHERE idBarang='$idB'");
        }

        unset($_SESSION['keranjang']);
        echo "<script>alert('Transaksi Berhasil Disimpan!'); window.location='index.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Transaksi Kasir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">Tambah Barang</div>
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3">
                            <label>Pilih Barang</label>
                            <select name="idBarang" class="form-select" required>
                                <?php
                                $brg = mysqli_query($conn, "SELECT * FROM barang WHERE stok > 0");
                                while($row = mysqli_fetch_assoc($brg)) {
                                    echo "<option value='".$row['idBarang']."'>".$row['namaBarang']." (Stok: ".$row['stok'].")</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Jumlah</label>
                            <input type="number" name="jumlah" class="form-control" min="1" value="1">
                        </div>
                        <button type="submit" name="tambah_keranjang" class="btn btn-primary w-100">Tambah ke Keranjang</button>
                    </form>
                </div>
            </div>
            <a href="index.php" class="btn btn-secondary w-100">Kembali ke Dashboard</a>
        </div>

        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">Keranjang Belanja</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Barang</th>
                                <th>Harga</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $grandTotal = 0;
                            if(!empty($_SESSION['keranjang'])): 
                                foreach($_SESSION['keranjang'] as $key => $val): 
                                    $grandTotal += $val['subtotal'];
                            ?>
                            <tr>
                                <td><?= $val['nama'] ?></td>
                                <td>Rp <?= number_format($val['harga']) ?></td>
                                <td><?= $val['qty'] ?></td>
                                <td>Rp <?= number_format($val['subtotal']) ?></td>
                                <td><a href="?hapus=<?= $key ?>" class="btn btn-danger btn-sm">X</a></td>
                            </tr>
                            <?php endforeach; endif; ?>
                        </tbody>
                        <tfoot>
                            <tr class="table-warning fw-bold">
                                <td colspan="3" class="text-end">Total Bayar:</td>
                                <td colspan="2">Rp <?= number_format($grandTotal) ?></td>
                            </tr>
                        </tfoot>
                    </table>
                    
                    <?php if($grandTotal > 0): ?>
                    <form method="POST">
                        <button type="submit" name="checkout" class="btn btn-success w-100 mt-3">Proses Transaksi & Simpan</button>
                    </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>