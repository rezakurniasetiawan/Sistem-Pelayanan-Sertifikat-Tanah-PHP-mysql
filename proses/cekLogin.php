<?php

session_start();


include '../koneksi.php';


$email = $_POST['email'];
$password = md5($_POST["password"]);


$login = mysqli_query($koneksi, "select * from tb_user where email='$email' and password='$password'");
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);


if ($cek > 0) {

    $data = mysqli_fetch_assoc($login);
    $_SESSION['id']    = $data['id'];
    $_SESSION['nama']    = $data['nama'];

    $_SESSION['bidang']    = $data['bidang'];

    $_SESSION['password']    = $data['password'];
    $_SESSION['email']    = $data['email'];
    $_SESSION['hakakses']    = $data['hakakses'];
    $_SESSION['foto']    = $data['foto'];


    if ($data['hakakses'] == "admin") {

        $_SESSION['email'] = $email;
        $_SESSION['hakakses'] = "admin";

        header("location:../dashboardAdmin/index.php");
    } else if ($data['hakakses'] == "member") {

        $_SESSION['email'] = $email;
        $_SESSION['hakakses'] = "member";

        header("location:../dashboardMember/index.php");
    } else {

        echo "<script>alert('Login gagal , coba ulangi lagi.');window.location='../login.php';</script>";
    }
} else {
    echo "<script>alert('Login gagal , coba ulangi lagi.');window.location='../login.php';</script>";
}
