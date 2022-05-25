<?php
//Include file koneksi ke database
include "../../koneksi.php";

//menerima nilai dari kiriman form input-barang 
$nama = $_POST["nama"];
$email = $_POST["email"];
$password = md5($_POST["password"]);
$hakakses = $_POST["hakakses"];
$akses = $_POST["akses"];
$unit = $_POST["unit"];
$nip = $_POST["nip"];
$created_at = $_POST["created_at"];
$created_up = $_POST["created_up"];


//Cek email sudah terdaftar atau belum
$cekresult = mysqli_query($koneksi, "SELECT email FROM tb_user WHERE email = '$email'");
if (mysqli_fetch_assoc($cekresult)) {
    echo "<script>alert('Email sudah digunakan.');window.location='../tambahUser.php';</script>";
} else {
    //query insert data
    $query = "INSERT INTO  tb_user (nama,email,password,hakakses,akses,unit,nip,created_at,created_up,foto)
				            VALUES
				        ('$nama','$email','$password','$hakakses','$akses','$unit','$nip','$created_at','$created_up','870-person.png')
				            ";
    $result = mysqli_query($koneksi, $query);
    // periska query apakah ada error
    if (!$result) {
        die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
            " - " . mysqli_error($koneksi));
    } else {
        //tampil alert dan akan redirect ke halaman index.php
        //silahkan ganti index.php sesuai halaman yang akan dituju
        echo "<script>alert('User berhasil ditambah.');window.location='../dataUser.php';</script>";
    }
}
