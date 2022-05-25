<?php
include '../../koneksi.php';

// PROSES DELETE

$id = $_GET["id"];

//jalankan query DELETE untuk menghapus data
$query = "DELETE FROM tb_user WHERE id='$id' ";
$hasil_query = mysqli_query($koneksi, $query);

//periksa query, apakah ada kesalahan
if (!$hasil_query) {
    die("Gagal menghapus data: " . mysqli_errno($koneksi) .
        " - " . mysqli_error($koneksi));
} else {
    echo "<script>alert('Admin berhasil dihapus.');window.location='../dataAdmin.php';</script>";
}
