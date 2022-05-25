<?php

include '../../koneksi.php';

$id = $_POST['id'];

$select = "UPDATE tb_pinjambuku SET info = 'sudah dikembalikan' , notif=3 WHERE  id = '$id'";
$result = mysqli_query($koneksi, $select);

echo "<script>alert('Berhasil Dikembalikan.');window.location='../dataPeminjaman.php';</script>";
