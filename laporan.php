<?php
session_start();
include 'koneksi.php';

// Proteksi: Hanya Owner yang bisa melihat laporan
if (!isset($_SESSION['user']) || $_SESSION['role'] != 'Owner') {
    header("Location: index.php");
    exit;
}

// Inisialisasi variabel untuk filter tanggal
$tgl_mulai = isset($_POST['tgl_mulai']) ? $_POST['tgl_mulai'] : date('Y-m-01');
$tgl_selesai = isset($_POST['tgl_selesai']) ? $_POST['tgl_selesai'] : date('Y-m-t');

// Query Laporan Penjualan (Sesuai class LaporanPenjualan)
$query = "SELECT t.idTransaksi, t.tanggal, t.totalBayar, t.namaKasir, 
          GROUP_CONCAT(CONCAT(b.namaBarang, ' (', dt.jumlah, ')') SEPARATOR ', ') as rincian_barang
          FROM transaksi t
          JOIN detail_transaksi dt ON t.idTransaksi = dt.idTransaksi
          JOIN barang b ON dt.idBarang = b.idBarang
          WHERE DATE(t.tanggal) BETWEEN '$tgl_mulai' AND '$tgl_selesai'
          GROUP BY t.idTransaksi
          ORDER BY t.tanggal DESC";

$laporan = mysqli_query($conn, $query);

// Menghitung Total Pendapatan (totalPendapatan: int)
$query_total = "SELECT SUM(totalBayar) as grand_total FROM transaksi 
                WHERE DATE(tanggal) BETWEEN '$tgl_mulai' AND '$tgl_selesai'";
$res_total = mysqli_query($conn, $query_total);
$data_total = mysqli_fetch_assoc($res_total);
$total_omzet = $data_total['grand_total'] ?? 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan - PT Jaya Abadi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3><i class="fas fa-chart-bar me-2"></i> Laporan Penjualan</h3>
        <a href="index.php" class="btn btn-secondary rounded-pill btn-sm">Kembali ke Dashboard</a>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form method="POST" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label small fw-bold">Tanggal Mulai</label>
                    <input type="date" name="tgl_mulai" class="form-control" value="<?= $tgl_mulai ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold">Tanggal Selesai</label>
                    <input type="date" name="tgl_selesai" class="form-control" value="<?= $tgl_selesai ?>">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary w-100 rounded-pill">Filter Laporan</button>
                </div>
            </form>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card bg-success text-white border-0 shadow-sm">
                <div class="card-body p-4 text-center">
                    <h6 class="text-uppercase small">Total Pendapatan Periode Ini</h6>
                    <h1 class="display-4 fw-bold">Rp <?= number_format($total_omzet) ?></h1>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Tanggal</th>
                        <th>Kasir</th>
                        <th>Barang (Qty)</th>
                        <th class="text-end">Total Bayar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(mysqli_num_rows($laporan) > 0): ?>
                        <?php while($row = mysqli_fetch_assoc($laporan)): ?>
                        <tr>
                            <td>#<?= $row['idTransaksi'] ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($row['tanggal'])) ?></td>
                            <td><span class="badge bg-info text-dark"><?= $row['namaKasir'] ?></span></td>
                            <td><small><?= $row['rincian_barang'] ?></small></td>
                            <td class="text-end fw-bold">Rp <?= number_format($row['totalBayar']) ?></td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">Tidak ada data penjualan pada periode ini.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="mt-3 text-end text-muted small">
        <p>Laporan digenerate pada: <?= date('d-m-Y H:i:s') ?></p>
    </div>
</div>

</body>
</html>