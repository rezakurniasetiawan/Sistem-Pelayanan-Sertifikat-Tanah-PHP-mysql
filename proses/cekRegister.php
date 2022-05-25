<?php
//Include file koneksi ke database
include "../koneksi.php";

//menerima nilai dari kiriman form input-barang 
$nama = $_POST["nama"];
$email = $_POST["email"];
$password = md5($_POST["password"]);
$hakakses = $_POST["hakakses"];
$unit = $_POST["unit"];
$nip = $_POST["nip"];
$created_at = $_POST["created_at"];
$created_up = $_POST["created_up"];

//query insert data
$query = "INSERT INTO  tb_user
				            VALUES
				        ('','$nama','$email','$password','$hakakses','$unit','$nip','$created_at','$created_up','')
				            ";
mysqli_query($koneksi, $query);

// cek apakah data berhasil ditambahkan
if (mysqli_affected_rows($koneksi) > 0) {
    echo "<script>
				            alert('Daftar Berhasil, silahkan login');
				            document.location.href = '../login.php'
				            </script>";
}
