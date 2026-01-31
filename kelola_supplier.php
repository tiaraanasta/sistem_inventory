<?php
session_start();
include 'koneksi.php';

// Pastikan hanya Owner yang bisa mengelola supplier sesuai Class Owner di diagram
if (!isset($_SESSION['user']) || $_SESSION['role'] != 'Owner') {
    header("Location: index.php");
    exit;
}

// 1. Logika Tambah Supplier
if (isset($_POST['tambah_supplier'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['namaSupplier']);
    $telp = mysqli_real_escape_string($conn, $_POST['noTelepon']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);

    $query = "INSERT INTO supplier (namaSupplier, noTelepon, alamat) VALUES ('$nama', '$telp', '$alamat')";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Supplier berhasil ditambahkan!'); window.location='kelola_supplier.php';</script>";
    }
}

// 2. Logika Hapus Supplier
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM supplier WHERE idSupplier = '$id'");
    header("Location: kelola_supplier.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Supplier - Sistem Inventory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css"> </head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Input Supplier Baru</h5>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Nama Perusahaan/Supplier</label>
                            <input type="text" name="namaSupplier" class="form-control" placeholder="Contoh: PT Jaya Abadi" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">No. Telepon</label>
                            <input type="text" name="noTelepon" class="form-control" placeholder="0812xxxx" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea name="alamat" class="form-control" rows="3" required></textarea>
                        </div>
                        <button type="submit" name="tambah_supplier" class="btn btn-primary w-100 rounded-pill">Simpan Supplier</button>
                    </form>
                </div>
            </div>
            <a href="index.php" class="btn btn-link w-100 mt-3 text-secondary text-decoration-none">← Kembali ke Dashboard</a>
        </div>

        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white">
                    <h5 class="mb-0 text-dark">Daftar Supplier Resmi</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nama Supplier</th>
                                    <th>Kontak</th>
                                    <th>Alamat</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $res = mysqli_query($conn, "SELECT * FROM supplier ORDER BY idSupplier DESC");
                                while($row = mysqli_fetch_assoc($res)) :
                                ?>
                                <tr>
                                    <td class="fw-bold text-primary"><?= $row['namaSupplier']; ?></td>
                                    <td><?= $row['noTelepon']; ?></td>
                                    <td><small class="text-muted"><?= $row['alamat']; ?></small></td>
                                    <td class="text-center">
                                        <a href="?hapus=<?= $row['idSupplier']; ?>" 
                                           class="btn btn-outline-danger btn-sm rounded-pill" 
                                           onclick="return confirm('Hapus supplier ini?')">
                                           Hapus
                                        </a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>