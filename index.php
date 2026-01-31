<?php
session_start();
include 'koneksi.php';

// Proteksi halaman: jika belum login, lempar ke login.php
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$role = $_SESSION['role'];
$username = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistem Inventory PT Jaya Abadi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background-color: #f4f7f6; }
        .card-menu {
            transition: transform 0.3s;
            border: none;
            border-radius: 15px;
        }
        .card-menu:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .icon-box {
            font-size: 3rem;
            margin-bottom: 15px;
            color: #0d6efd;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#"><i class="fas fa-warehouse me-2"></i> JAYA ABADI POS</a>
        <div class="navbar-nav ms-auto">
            <span class="nav-link text-light me-3">
                <i class="fas fa-user-circle me-1"></i> <?= $username; ?> (<strong><?= $role; ?></strong>)
            </span>
            <a href="logout.php" class="btn btn-danger btn-sm px-3 rounded-pill">
                <i class="fas fa-sign-out-alt me-1"></i> Logout
            </a>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="row mb-4 text-center">
        <div class="col">
            <h2 class="fw-bold text-secondary">Dashboard Utama</h2>
            <p class="text-muted">Selamat datang di sistem manajemen inventory dan penjualan.</p>
        </div>
    </div>

    <div class="row g-4 justify-content-center">
        
        <div class="col-md-4 col-lg-3">
            <div class="card card-menu h-100 text-center p-4">
                <div class="icon-box"><i class="fas fa-shopping-cart"></i></div>
                <h5>Transaksi</h5>
                <p class="text-muted small">Input penjualan barang baru.</p>
                <a href="transaksi.php" class="btn btn-primary mt-auto rounded-pill">Buka Transaksi</a>
            </div>
        </div>

        <div class="col-md-4 col-lg-3">
            <div class="card card-menu h-100 text-center p-4">
                <div class="icon-box text-warning"><i class="fas fa-boxes"></i></div>
                <h5>Cek Stok</h5>
                <p class="text-muted small">Lihat sisa ketersediaan barang.</p>
                <a href="stok.php" class="btn btn-warning text-white mt-auto rounded-pill">Lihat Stok</a>
            </div>
        </div>

        <?php if ($role == 'Owner') : ?>
            
            <div class="col-md-4 col-lg-3">
                <div class="card card-menu h-100 text-center p-4">
                    <div class="icon-box text-success"><i class="fas fa-box-open"></i></div>
                    <h5>Kelola Barang</h5>
                    <p class="text-muted small">Tambah, edit, atau hapus data barang.</p>
                    <a href="kelola_barang.php" class="btn btn-success mt-auto rounded-pill">Kelola</a>
                </div>
            </div>

            <div class="col-md-4 col-lg-3">
                <div class="card card-menu h-100 text-center p-4">
                    <div class="icon-box text-info"><i class="fas fa-users"></i></div>
                    <h5>Kelola Karyawan</h5>
                    <p class="text-muted small">Manajemen data pegawai/kasir.</p>
                    <a href="kelola_karyawan.php" class="btn btn-info text-white mt-auto rounded-pill">Kelola</a>
                </div>
            </div>

            <div class="col-md-4 col-lg-3">
                <div class="card card-menu h-100 text-center p-4">
                    <div class="icon-box text-dark"><i class="fas fa-truck"></i></div>
                    <h5>Kelola Supplier</h5>
                    <p class="text-muted small">Data PT Jaya Abadi & Supplier lain.</p>
                    <a href="kelola_supplier.php" class="btn btn-dark mt-auto rounded-pill">Kelola</a>
                </div>
            </div>

            <div class="col-md-4 col-lg-3">
                <div class="card card-menu h-100 text-center p-4">
                    <div class="icon-box text-danger"><i class="fas fa-chart-line"></i></div>
                    <h5>Laporan</h5>
                    <p class="text-muted small">Lihat omzet dan total pendapatan.</p>
                    <a href="laporan.php" class="btn btn-danger mt-auto rounded-pill">Lihat Laporan</a>
                </div>
            </div>

        <?php endif; ?>

    </div>
</div>

<footer class="text-center mt-5 py-4 text-muted">
    <small>&copy; 2024 PT Jaya Abadi - Sistem Inventory Berbasis Web</small>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>