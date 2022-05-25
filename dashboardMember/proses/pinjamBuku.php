<?php

include '../../koneksi.php';

$email = $_POST["email"];
$nama = $_POST["nama"];
$nip = $_POST["nip"];
$unit = $_POST["unit"];
$no_telp = $_POST["no_telp"];
$kode_buku = $_POST["kode_buku"];
$kelurahan = $_POST["kelurahan"];
$tahun_buku = $_POST["tahun_buku"];
$tgl_pinjam = $_POST["tgl_pinjam"];
$tgl_kembali = $_POST["tgl_kembali"];
$info = $_POST["info"];
$notif = $_POST["notif"];
$created_at = $_POST["created_at"];

$query = "INSERT INTO tb_pinjambuku (email,nama,nip,unit,no_telp,kode_buku,kelurahan,tahun_buku,tgl_pinjam,tgl_kembali,info,notif,created_at) 
VALUES ('$email','$nama','$nip','$unit','$no_telp','$kode_buku','$kelurahan','$tahun_buku','$tgl_pinjam','$tgl_kembali','$info','$notif','$created_at')";
$result = mysqli_query($koneksi, $query);
// periska query apakah ada error
if (!$result) {
    die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
        " - " . mysqli_error($koneksi));
} else {
    //tampil alert dan akan redirect ke halaman index.php
    //silahkan ganti index.php sesuai halaman yang akan dituju
    echo "<script>alert('Berhasil meminjam buku');window.location='../dataPeminjaman.php';</script>";
}
