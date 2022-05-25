<?php

include '../../koneksi.php';

$id = $_POST["id"];
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
$created_at = $_POST["created_at"];

$query = "UPDATE tb_pinjambuku SET email='$email',nama='$nama',nip='$nip',unit='$unit',no_telp='$no_telp',kode_buku='$kode_buku',kelurahan='$kelurahan',tahun_buku='$tahun_buku',tgl_pinjam='$tgl_pinjam',tgl_kembali='$tgl_kembali',created_at='$created_at'";
$query .= "WHERE id = '$id'";
$result = mysqli_query($koneksi, $query);
// periska query apakah ada error
if (!$result) {
    die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
        " - " . mysqli_error($koneksi));
} else {
    //tampil alert dan akan redirect ke halaman index.php
    //silahkan ganti index.php sesuai halaman yang akan dituju
    echo "<script>alert('Data berhasil diubah');window.location='../dataPeminjaman.php';</script>";
}
