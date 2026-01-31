<?php
$conn = mysqli_connect("localhost", "root", "", "sistem_inventory");
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>