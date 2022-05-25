<?php
include "../koneksi.php"; //Include file koneksi
$searchTerm = $_GET['term']; // Menerima kiriman data dari inputan pengguna

$sql = "SELECT * FROM tb_kelurahan WHERE kelurahan LIKE '%" . $searchTerm . "%' ORDER BY nama ASC"; // query sql untuk menampilkan data mahasiswa dengan operator LIKE

$hasil = mysqli_query($koneksi, $sql); //Query dieksekusi

//Disajikan dengan menggunakan perulangan
while ($row = mysqli_fetch_array($hasil)) {
    $data[] = $row['kelurahan'];
}
//Nilainya disimpan dalam bentuk json
echo json_encode($data);
