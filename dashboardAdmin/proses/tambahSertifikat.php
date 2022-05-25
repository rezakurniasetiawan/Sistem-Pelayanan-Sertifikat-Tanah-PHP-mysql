<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include '../../koneksi.php';

// membuat variabel untuk menampung data dari form
$email = $_POST["email"];
$no_agenda = $_POST["no_agenda"];
$no_hak = $_POST["no_hak"];
$n_pem_hak = $_POST["n_pem_hak"];
$no_seri = $_POST["no_seri"];
$pekerjaan = $_POST["pekerjaan"];
$tgl_208 = $_POST["tgl_208"];
$no_301 = $_POST["no_301"];
$no_berkas = $_POST["no_berkas"];
$tahun_berkas = $_POST["tahun_berkas"];
$luas = $_POST["luas"];
$kelurahan = $_POST["kelurahan"];
$status_sertif = $_POST["status_sertif"];
$nama_penerima = $_POST["nama_penerima"];
$nik_penerima = $_POST["nik_penerima"];
$tgl_pengambilan     = $_POST["tgl_pengambilan"];
$created_at = $_POST["created_at"];
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
        $query = "INSERT INTO tb_sertifikat (email,no_agenda,no_hak,n_pem_hak,no_seri,pekerjaan,tgl_208,no_301,no_berkas,tahun_berkas,luas,kelurahan,status_sertif,nama_penerima,nik_penerima,tgl_pengambilan,created_at,foto) 
        VALUES ('$email','$no_agenda','$no_hak','$n_pem_hak','$no_seri','$pekerjaan','$tgl_208','$no_301','$no_berkas','$tahun_berkas','$luas','$kelurahan','$status_sertif','$nama_penerima','$nik_penerima','$tgl_pengambilan','$created_at','$nama_gambar_baru')";
        $result = mysqli_query($koneksi, $query);
        // periska query apakah ada error
        if (!$result) {
            die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
                " - " . mysqli_error($koneksi));
        } else {
            //tampil alert dan akan redirect ke halaman index.php
            //silahkan ganti index.php sesuai halaman yang akan dituju
            echo "<script>alert('Data berhasil ditambah.');window.location='../index.php';</script>";
        }
    } else {
        //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
        echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='../index.php';</script>";
    }
} else {
    $query = "INSERT INTO tb_sertifikat (email,no_agenda,no_hak,n_pem_hak,no_seri,pekerjaan,tgl_208,no_301,no_berkas,tahun_berkas,luas,kelurahan,status_sertif,nama_penerima,nik_penerima,tgl_pengambilan,created_at) 
 VALUES ('$email','$no_agenda','$no_hak','$n_pem_hak','$no_seri','$pekerjaan','$tgl_208','$no_301','$no_berkas','$tahun_berkas','$luas','$kelurahan','$status_sertif','$nama_penerima','$nik_penerima','$tgl_pengambilan','$created_at')";
    $result = mysqli_query($koneksi, $query);
    // periska query apakah ada error
    if (!$result) {
        die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
            " - " . mysqli_error($koneksi));
    } else {
        //tampil alert dan akan redirect ke halaman index.php
        //silahkan ganti index.php sesuai halaman yang akan dituju
        echo "<script>alert('Data berhasil ditambah.');window.location='../index.php';</script>";
    }
}
