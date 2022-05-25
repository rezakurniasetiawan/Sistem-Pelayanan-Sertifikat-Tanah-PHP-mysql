<?php
include '../../koneksi.php';

$id = $_POST["id"];
$pekerjaan = $_POST["pekerjaan"];

$query  = "UPDATE tb_pekerjaan SET pekerjaan = '$pekerjaan'";
$query .= "WHERE id = '$id'";
$result = mysqli_query($koneksi, $query);
if (!$result) {
    die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
        " - " . mysqli_error($koneksi));
} else {
    echo "<script>alert('Data berhasil diubah.');window.location='../dataPekerjaan.php';</script>";
}
