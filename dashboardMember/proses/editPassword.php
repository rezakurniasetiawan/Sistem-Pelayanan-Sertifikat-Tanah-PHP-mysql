<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include '../../koneksi.php';

// membuat variabel untuk menampung data dari form
$id = $_POST["id"];
$password = md5($_POST["password"]);

$query = "UPDATE tb_user SET password='$password'";
$query .= "WHERE id = '$id'";
$result = mysqli_query($koneksi, $query);

// periska query apakah ada error
if (!$result) {
    die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
        " - " . mysqli_error($koneksi));
} else {
    //tampil alert dan akan redirect ke halaman index.php
    //silahkan ganti index.php sesuai halaman yang akan dituju
    echo "<script>alert('password berhasil diubah. Silahkan login kembali');window.location='../../proses/cekLogout.php';</script>";
}
