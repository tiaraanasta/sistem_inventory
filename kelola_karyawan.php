<?php
session_start();
include 'koneksi.php';
if ($_SESSION['role'] != 'Owner') header("Location: index.php");

if (isset($_POST['tambah_k'])) {
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $telp = $_POST['telp'];
    mysqli_query($conn, "INSERT INTO karyawan (namaKaryawan, jabatan, noTelepon) VALUES ('$nama', '$jabatan', '$telp')");
}
?>
<!DOCTYPE html>
<html>
<head><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="p-4">
    <h3>👥 Kelola Karyawan</h3>
    <form method="POST" class="row g-2 mb-4">
        <div class="col-md-4"><input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required></div>
        <div class="col-md-3"><input type="text" name="jabatan" class="form-control" placeholder="Jabatan (Kasir/Gudang)" required></div>
        <div class="col-md-3"><input type="text" name="telp" class="form-control" placeholder="Nomor Telepon"></div>
        <div class="col-md-2"><button type="submit" name="tambah_k" class="btn btn-primary w-100">Tambah</button></div>
    </form>

    <table class="table table-striped">
        <thead><tr><th>ID</th><th>Nama</th><th>Jabatan</th><th>Telepon</th></tr></thead>
        <tbody>
            <?php
            $karyawan = mysqli_query($conn, "SELECT * FROM karyawan");
            while($k = mysqli_fetch_assoc($karyawan)) : ?>
            <tr>
                <td><?= $k['idKaryawan'] ?></td>
                <td><?= $k['namaKaryawan'] ?></td>
                <td><?= $k['jabatan'] ?></td>
                <td><?= $k['noTelepon'] ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <a href="index.php" class="btn btn-secondary">Kembali</a>
</body>
</html>