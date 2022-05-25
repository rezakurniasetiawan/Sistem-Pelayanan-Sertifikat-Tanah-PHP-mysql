<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include '../../koneksi.php';

// membuat variabel untuk menampung data dari form
$id = $_POST["id"];
$unit = $_POST["unit"];
$foto = $_FILES['foto']['name'];

//cek dulu jika ada gambar produk jalankan coding ini
if ($foto != "") {
    $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg',); //ekstensi file gambar yang bisa diupload 
    $x = explode('.', $foto); //memisahkan nama file dengan ekstensi yang diupload
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['foto']['tmp_name'];
    $angka_acak     = rand(1, 999);
    $nama_gambar_baru = $angka_acak . '-' . $foto; //menggabungkan angka acak dengan nama file sebenarnya
    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
        move_uploaded_file($file_tmp, '../../gambar/' . $nama_gambar_baru); //memindah file gambar ke folder gambar
        // jalankan query INSERT untuk menambah data ke database pastikan sesuai urutan (id tidak perlu karena dibikin otomatis)
        $query = "UPDATE tb_user SET unit='$unit',foto='$nama_gambar_baru'";
        $query .= "WHERE id = '$id'";
        $result = mysqli_query($koneksi, $query);
        // periska query apakah ada error
        if (!$result) {
            die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
                " - " . mysqli_error($koneksi));
        } else {
            //tampil alert dan akan redirect ke halaman index.php
            //silahkan ganti index.php sesuai halaman yang akan dituju
            echo "<script>alert('Data berhasil diedit.');window.location='../profil.php';</script>";
        }
    } else {
        //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
        echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='../profil.php';</script>";
    }
} else {
    $query = "UPDATE tb_user SET unit='$unit'";
    $query .= "WHERE id = '$id'";
    $result = mysqli_query($koneksi, $query);

    // periska query apakah ada error
    if (!$result) {
        die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
            " - " . mysqli_error($koneksi));
    } else {
        //tampil alert dan akan redirect ke halaman index.php
        //silahkan ganti index.php sesuai halaman yang akan dituju
        echo "<script>alert('Profil berhasil diedit.');window.location='../profil.php';</script>";
    }
}
