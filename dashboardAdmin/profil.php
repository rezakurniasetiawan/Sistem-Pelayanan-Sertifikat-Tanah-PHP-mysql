<?php
ob_start();
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: ../login.php");
}
if ($_SESSION['hakakses'] != "admin") {
    die("<b>Oops!</b> Access Failed.
		<button type='button' onclick=location.href='./'>Back</button>");
}
include '../koneksi.php';
$usermember = mysqli_query($koneksi, "SELECT nama FROM tb_user WHERE akses='Member'");
$jumlah_usermember = mysqli_num_rows($usermember);

$usermoderator = mysqli_query($koneksi, "SELECT nama FROM tb_user WHERE akses='Moderator'");
$jumlah_moderator = mysqli_num_rows($usermoderator);

$usersertifikat = mysqli_query($koneksi, "SELECT email FROM tb_sertifikat");
$jumlah_sertifikat = mysqli_num_rows($usersertifikat);

$userpinjambuku = mysqli_query($koneksi, "SELECT email FROM tb_pinjambuku");
$jumlah_buku = mysqli_num_rows($userpinjambuku);


$tampilPeg    = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE email='$_SESSION[email]'");
$peg    = mysqli_fetch_array($tampilPeg);

?>
<?php
// include('koneksi.php');

//membuat pagimasi
$batas = 8;
$halaman = isset($_GET['hal']) ? (int)$_GET['hal'] : 1;
$halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

$previous = $halaman - 1;
$next = $halaman + 1;

$data = mysqli_query($koneksi, "select * from tb_pinjambuku ORDER BY created_at DESC");
$jumlah_data = mysqli_num_rows($data);
$total_halaman = ceil($jumlah_data / $batas);

// jalankan query untuk menampilkan semua data diurutkan berdasarkan nim
$query = "SELECT * FROM tb_pinjambuku  ORDER BY created_at DESC limit $halaman_awal, $batas";
$result = mysqli_query($koneksi, $query);

//mengecek apakah ada error ketika menjalankan query
if (!$result) {
    die("Query Error: " . mysqli_errno($koneksi) .
        " - " . mysqli_error($koneksi));
}

//buat perulangan untuk element tabel dari data mahasiswa
$no = 1; //variabel untuk membuat nomor urut
while ($row = mysqli_fetch_assoc($result)) {
?>

    <?php
    $exp_date = $row['tgl_kembali'];
    $today_date = date('d-m-Y');

    $exp = strtotime($exp_date);
    $td = strtotime($today_date);

    if ($td > $exp) {
        $id_user_date = $row['id'];

        $data_notif = $row['notif'];
        if ($data_notif == 3) {
            $sql_updatelagi = mysqli_query($koneksi, "UPDATE tb_pinjambuku SET notif=3 WHERE id='$id_user_date'");
        } else {
            $sql_update = mysqli_query($koneksi, "UPDATE tb_pinjambuku SET notif=1, WHERE id='$id_user_date'");
        }
    }
    ?>

<?php
    $no++; //untuk nomor urut terus bertambah 1
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="shortcut icon" href="../assets/images/logo_badan.png">

    <!-- App css -->
    <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/app.min.css" rel="stylesheet" type="text/css" id="light-style">
    <link href="../assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="dark-style">

</head>

<body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
    <!-- Begin page -->
    <div class="wrapper">
        <!-- ========== Left Sidebar Start ========== -->
        <div class="leftside-menu">

            <!-- LOGO -->
            <a href="index.html" class="logo text-center logo-light">
                <span class="logo-lg">
                    <img src="../assets/images/logo-light.png" alt="" height="24">
                </span>
                <span class="logo-sm">
                    <img src="../assets/images/logo_badan.png" alt="" height="16">
                </span>
            </a>

            <!-- LOGO -->
            <a href="index.php" class="logo text-center logo-dark">
                <span class="logo-lg">
                    <img src="../assets/images/logo-dark.png" alt="" height="16">
                </span>
                <span class="logo-sm">
                    <img src="../assets/images/logo_sm_dark.png" alt="" height="16">
                </span>
            </a>

            <div class="h-100" id="leftside-menu-container" data-simplebar="">

                <!--- Sidemenu -->
                <ul class="side-nav">


                    <li class="side-nav-item">
                        <a href="index.php" class="side-nav-link">
                            <i class="uil-home-alt"></i>
                            <span> Dashboards </span>
                        </a>
                    </li>

                    <li class="side-nav-title side-nav-item">Apps</li>


                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#sidebarEcommerce" aria-expanded="false" aria-controls="sidebarEcommerce" class="side-nav-link">
                            <i class="uil-user"></i>
                            <span> Data User </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarEcommerce">
                            <ul class="side-nav-second-level">
                                <li>
                                    <a href="dataUser.php">User</a>
                                </li>
                                <li>
                                    <a href="dataAdmin.php">Admin</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="side-nav-item">
                        <a href="dataPekerjaan.php" class="side-nav-link">
                            <i class="uil-bag-alt"></i>
                            <span> Pekerjaan </span>
                        </a>
                    </li>
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#sidebarSertifikat" aria-expanded="false" aria-controls="sidebarEcommerce" class="side-nav-link">
                            <i class="uil-package"></i>
                            <span> Data Sertifkat </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarSertifikat">
                            <ul class="side-nav-second-level">
                                <li>
                                    <a href="sudahDiambil.php">Sudah diambil</a>
                                </li>
                                <li>
                                    <a href="belumDiambil.php">Belum diambil</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="side-nav-item">
                        <a href="dataPeminjaman.php" class="side-nav-link">
                            <i class="uil-book-open"></i>
                            <span> Data Peminjaman </span>
                        </a>
                    </li>
                </ul>
                <div class="help-box text-white text-center">
                    <img src="../assets/images/help-icon.svg" height="90" alt="Helper Icon Image">
                    <h5 class="mt-3">Sertifkat Tanah</h5>
                    <a href="tambahSertifikat.php" class="btn btn-outline-light btn-sm">Tambah</a>
                </div>

                <!-- end Help Box -->
                <!-- End Sidebar -->

                <div class="clearfix"></div>

            </div>
            <!-- Sidebar -left -->

        </div>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">
                <!-- Topbar Start -->
                <div class="navbar-custom">
                    <ul class="list-unstyled topbar-menu float-end mb-0">
                        <!-- <li class="dropdown notification-list d-lg-none">
                            <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="dripicons-search noti-icon"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-animated dropdown-lg p-0">
                                <form class="p-3">
                                    <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                </form>
                            </div>
                        </li> -->

                        <li class="dropdown notification-list">
                            <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="dripicons-bell noti-icon"></i>
                                <?php
                                $sql_get = mysqli_query($koneksi, "SELECT * from tb_pinjambuku WHERE notif=1 ");
                                $count = mysqli_num_rows($sql_get);

                                if ($count > 0) {
                                    echo '<span class="noti-icon-badge"></span>';
                                }
                                ?>

                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg">

                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h5 class="m-0">
                                        <span class="float-end">

                                        </span>Notification
                                    </h5>
                                </div>

                                <div style="max-height: 230px;" data-simplebar="">
                                    <!-- item-->
                                    <?php
                                    $sqlget3 = mysqli_query($koneksi, "SELECT * from tb_pinjambuku WHERE notif=1");
                                    ?>
                                    <div class="dropdown-item notify-item">
                                        <?php
                                        if (mysqli_num_rows($sqlget3) > 0) {
                                            while ($result2 = mysqli_fetch_assoc($sqlget3)) {
                                                echo '<a href="notifikasi.php?id=' . $result2['id'] . '" >   <div class="notify-icon bg-primary">
                                                <i class="mdi mdi-comment-account-outline"></i>
                                            </div>
                                            <p class="notify-details">' . $result2['kode_buku'] . '
                                                <small class="text-muted">Waktunya dikembalikan</small>
                                            </p></a>';
                                            }
                                        } else {
                                            echo '  <center><span class="badge badge-danger-lighten">Belum ada notifikasi</span></center>';
                                        }
                                        ?>

                                    </div>

                                </div>

                            </div>
                        </li>

                        <li class="dropdown notification-list">
                            <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <span class="account-user-avatar">
                                    <img src="../gambar/<?php echo $peg['foto']; ?>" alt="user-image" class="rounded-circle">
                                </span>
                                <span>
                                    <span class="account-user-name"><?php echo $peg['nama']; ?></span>
                                    <span class="account-position"><?php echo $peg['hakakses']; ?></span>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                                <!-- item-->
                                <div class=" dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Welcome !</h6>
                                </div>

                                <!-- item-->
                                <a href="profil.php" class="dropdown-item notify-item">
                                    <i class="mdi mdi-account-circle me-1"></i>
                                    <span>My Account</span>
                                </a>

                                <!-- item-->
                                <a href="../proses/cekLogout.php" class="dropdown-item notify-item">
                                    <i class="mdi mdi-logout me-1"></i>
                                    <span>Logout</span>
                                </a>
                            </div>
                        </li>

                    </ul>
                    <button class="button-menu-mobile open-left">
                        <i class="mdi mdi-menu"></i>
                    </button>
                    <!-- <div class="app-search dropdown d-none d-lg-block">
                        <form>
                            <div class="input-group">
                                <input type="text" class="form-control dropdown-toggle" placeholder="Search..." id="top-search">
                                <span class="mdi mdi-magnify search-icon"></span>
                                <button class="input-group-text btn-primary" type="submit">Search</button>
                            </div>
                        </form>
                    </div> -->
                </div>
                <!-- end Topbar -->

                <!-- Start Content-->
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">

                                <h4 class="page-title">Profil</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Profile -->
                            <div class="card bg-primary">
                                <div class="card-body profile-user-box">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <div class="avatar-lg">
                                                        <img src="../gambar/<?php echo $peg['foto']; ?>" alt="" height="100" class="img-thumbnail">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <h4 class="mt-1 mb-1 text-white"><?php echo $peg['nama']; ?></h4>

                                                        <ul class="mb-0 list-inline text-light">
                                                            <li class="list-inline-item me-3">
                                                                <h5 class="mb-1">Bergabung pada :</h5>
                                                                <p class="mb-0 font-13 text-white-50"><?php echo $peg['created_at']; ?></p>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- end col-->

                                        <div class="col-sm-4">
                                            <div class="text-center mt-sm-0 mt-3 text-sm-end">
                                                <a href="editPassword.php?id=<?php echo $peg['id']; ?>"">
                                                    <button type=" button" class="btn btn-light">
                                                    <i class="mdi mdi-account-edit me-1"></i> Edit Password
                                                    </button>
                                                </a>
                                            </div>
                                        </div> <!-- end col-->
                                    </div> <!-- end row -->
                                </div> <!-- end card-body/ profile-user-box-->
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="page-title-box">

                                        <h4 class="page-title">Data Profil</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="text-center mt-sm-0 mt-3 text-sm-end">
                                                <a href="editProfil.php?id=<?php echo $peg['id']; ?>"">
                                                    <button type=" button" class="btn btn-success">
                                                    <i class="mdi mdi-account-edit me-1"></i> Edit Profil
                                                    </button>
                                                </a>
                                            </div>
                                            <div class="mb-2">
                                                <label for="example-input-small" class="form-label">Nama</label>
                                                <input type="text" disabled id="example-input-small" name="unit" value="<?php echo $peg['nama']; ?>" class="form-control form-control-sm">
                                            </div>
                                            <div class="mb-2">
                                                <label for="example-input-small" class="form-label">Email</label>
                                                <input type="text" disabled id="example-input-small" name="unit" value="<?php echo $peg['email']; ?>" class="form-control form-control-sm">
                                            </div>
                                            <br>


                                        </div> <!-- end card-body -->
                                    </div> <!-- end card -->
                                </div>
                                <div class="col-sm-4">

                                </div>
                            </div>

                            <!--end profile/ card -->
                        </div> <!-- end col-->
                    </div>
                    <!-- end row-->



                </div> <!-- container -->

            </div> <!-- content -->

            <!-- Footer Start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> ©
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->

    <div class="rightbar-overlay"></div>
    <!-- /End-bar -->

    <!-- bundle -->
    <script src="../assets/js/vendor.min.js"></script>
    <script src="../assets/js/app.min.js"></script>

    <!-- third party js -->
    <script src="../assets/js/vendor/Chart.bundle.min.js"></script>
    <!-- third party js ends -->

    <!-- demo app -->
    <script src="../assets/js/pages/demo.dashboard-projects.js"></script>
    <!-- end demo js-->

</body>

</html>