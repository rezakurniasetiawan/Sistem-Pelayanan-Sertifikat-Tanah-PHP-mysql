<?php
ob_start();
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: ../login.php");
}
if ($_SESSION['hakakses'] != "member") {
    die("<b>Oops!</b> Access Failed.
		<button type='button' onclick=location.href='./'>Back</button>");
}
include '../koneksi.php';

$tampilPeg    = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE email='$_SESSION[email]'");
$peg    = mysqli_fetch_array($tampilPeg);

?>
<?php

$query = "
SELECT * FROM tb_kelurahan 
ORDER BY kelurahan ASC
";

$result = $koneksi->query($query);

$data = array();

foreach ($result as $row) {
    $data[] = array(
        'label'     =>  $row['n_kelurahan'],
        'value'     =>  $row['n_kelurahan']
    );
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

    <!-- Bootstrap CSS -->
    <!-- <link href="../assets/library/bootstrap.min.css" rel="stylesheet" />
    <script src="../assets/library/bootstrap.bundle.min.js"></script> -->
    <script src="../assets/js/autocomplete.js"></script>

    <!-- App css -->
    <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/app.min.css" rel="stylesheet" type="text/css" id="light-style">
    <link href="../assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="dark-style">
    <script src="../assets/js/autocomplete.js"></script>
</head>
<style>
    .passport-box {
        display: none
    }

    .apply-box {
        margin-top: 10px;
        display: none
    }
</style>

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
                            <!-- <span class="badge bg-success float-end">4</span> -->
                            <span> Dashboards </span>
                        </a>
                    </li>
                    <li class="side-nav-item">
                        <a href="pinjamBuku.php" class="side-nav-link">
                            <i class="uil-book-alt"></i>
                            <span> Pinjam Buku </span>
                        </a>
                    </li>
                    <li class="side-nav-item">
                        <a href="dataPeminjaman.php" class="side-nav-link">
                            <i class="uil-book-open"></i>
                            <span> Data Peminjaman </span>
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
                </ul>
                <?php
                $query = "SELECT * FROM tb_user WHERE email='$_SESSION[email]'";
                $result = mysqli_query($koneksi, $query);


                if (!$result) {
                    die("Query Error: " . mysqli_errno($koneksi) .
                        " - " . mysqli_error($koneksi));
                }
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($row['akses'] == 'Moderator') {
                        echo '       <div class="help-box text-white text-center">
                        <img src="../assets/images/help-icon.svg" height="90" alt="Helper Icon Image">
                        <h5 class="mt-3">Sertifkat Tanah</h5>
                        <a href="tambahSertifikat.php" class="btn btn-outline-light btn-sm">Add</a>
                    </div>';
                    }
                }
                ?>

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
                                $sql_get = mysqli_query($koneksi, "SELECT * from tb_pinjambuku WHERE notif=1 and email='$_SESSION[email]'");
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
                                            <a href="javascript: void(0);" class="text-dark">
                                                <small>Clear All</small>
                                            </a>
                                        </span>Notification
                                    </h5>
                                </div>
                                <div style="max-height: 230px;" data-simplebar="">
                                    <!-- item-->
                                    <?php
                                    $sqlget3 = mysqli_query($koneksi, "SELECT * from tb_pinjambuku WHERE notif=1 and email='$_SESSION[email]'");
                                    ?>

                                    <?php
                                    if (mysqli_num_rows($sqlget3) > 0) {
                                        while ($result2 = mysqli_fetch_assoc($sqlget3)) {
                                            echo '<div class="dropdown-item notify-item"><a href="notifikasi.php?id=' . $result2['id'] . '" >   <div class="notify-icon bg-primary">
                                                <i class="mdi mdi-comment-account-outline"></i>
                                            </div>
                                            <p class="notify-details">' . $result2['kode_buku'] . '
                                                <small class="text-muted">Waktunya dikembalikan</small>
                                            </p></a></div>';
                                        }
                                    } else {
                                        echo '  <center><span class="badge badge-danger-lighten">Belum ada notifikasi</span></center>';
                                    }
                                    ?>

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

                                <h4 class="page-title">Tambah Sertifkat</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <form action="proses/tambahSertifikat.php" method="POST" enctype="multipart/form-data">
                                        <div class="mb-2">
                                            <label for="example-input-small" class="form-label">Nomor Agenda</label>
                                            <input name="no_agenda" type="text" autocomplete="off" id="example-input-small" class="form-control form-control-sm" required>
                                        </div>
                                        <div class="mb-2">
                                            <label for="example-input-small" class="form-label">Nomor Hak</label>
                                            <input name="no_hak" type="text" autocomplete="off" id="example-input-small" class="form-control form-control-sm" required>
                                        </div>
                                        <div class="mb-2">
                                            <label for="example-input-small" class="form-label">Nama Pemegang Hak</label>
                                            <input name="n_pem_hak" type="text" autocomplete="off" id="example-input-small" class="form-control form-control-sm" required>
                                        </div>
                                        <div class="mb-2">
                                            <label for="example-input-small" class="form-label">Nomor Seri</label>
                                            <input name="no_seri" type="text" autocomplete="off" id="example-input-small" class="form-control form-control-sm" required>
                                        </div>
                                        <div class="mb-2">
                                            <label for="example-select" class="form-label">Uraian Pekerjaan</label>
                                            <select name="pekerjaan" class="form-select" id="example-select" required>
                                                <option value="" selected="" disabled="">Pilih Uraian Pekerjaan</option>
                                                <?php
                                                $query = "SELECT * FROM tb_pekerjaan";
                                                $result = mysqli_query($koneksi, $query);


                                                if (!$result) {
                                                    die("Query Error: " . mysqli_errno($koneksi) .
                                                        " - " . mysqli_error($koneksi));
                                                }
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                ?>
                                                    <option value=" <?php echo $row['pekerjaan']; ?>"> <?php echo $row['pekerjaan']; ?></option>
                                                <?php
                                                }
                                                ?>

                                            </select>
                                        </div>
                                        <div class="mb-2">
                                            <label for="example-input-small" class="form-label">Tanggal DI.208</label>
                                            <input name="tgl_208" type="date" autocomplete="off" id="example-input-small" class="form-control form-control-sm" required>
                                        </div>
                                        <div class="mb-2">
                                            <label for="example-input-small" class="form-label">Nomor DI.301</label>
                                            <input name="no_301" type="text" autocomplete="off" id="example-input-small" class="form-control form-control-sm" required>
                                        </div>
                                        <div class="mb-2">
                                            <label for="example-input-small" class="form-label">Nomor Berkas</label>
                                            <input name="no_berkas" type="text" autocomplete="off" id="example-input-small" class="form-control form-control-sm" required>
                                        </div>
                                        <div class="mb-2">
                                            <label for="example-input-small" class="form-label">Tahun Berkas</label>
                                            <input name="tahun_berkas" type="text" autocomplete="off" id="example-input-small" class="form-control form-control-sm" required>
                                        </div>
                                        <div class="mb-2">
                                            <label for="example-input-small" class="form-label">Luas</label>
                                            <input name="luas" type="text" autocomplete="off" id="example-input-small" class="form-control form-control-sm" required>
                                        </div>
                                        <div class="mb-2">
                                            <label for="example-select" class="form-label">Kecamatan/Desa</label>
                                            <input type="text" name="kelurahan" autocomplete="off" value="" id="kelurahan" class="form-control form-control-sm" required />
                                        </div>
                                        <div class="checkbox-card">
                                            <h6 class="font-15 ">Status Sertifkat</h6>
                                            <div class="checkbox">
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" name="status_sertif" value="Belum diambil" class="form-check-input checkre" required>
                                                    <label class="form-check-label" for="customRadio4">Belum diambil</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" name="status_sertif" value="Sudah diambil" class="form-check-input checkme" required>
                                                    <label class="form-check-label" for="customRadio3">Sudah diambil</label>
                                                </div>
                                            </div>
                                            <div class="passport-box">
                                                <div class="mb-2 mt-2">
                                                    <label for="example-input-small" class="form-label">Nama Penerima</label>
                                                    <input name="nama_penerima" autocomplete="off" type="text" id="example-input-small" class="form-control form-control-sm">
                                                </div>
                                                <div class="mb-2">
                                                    <label for="example-input-small" class="form-label">NIK Penerima</label>
                                                    <input name="nik_penerima" autocomplete="off" type="text" id="example-input-small" class="form-control form-control-sm">
                                                </div>
                                                <div class="mb-2">
                                                    <label for="example-input-small" class="form-label">Tanggal Pengambilan</label>
                                                    <input name="tgl_pengambilan" autocomplete="off" type="date" id="example-input-small" class="form-control form-control-sm">
                                                </div>
                                                <div class="mb-2">
                                                    <label for="example-input-small" class="form-label">Bukti Fisik</label>
                                                    <input name="foto" type="file" autocomplete="off" id="example-input-small" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <input name="created_at" type="text" class="form-control" value="<?php date_default_timezone_set('Asia/Jakarta');
                                                                                                            echo date("d-m-Y H:i:s"); ?>" hidden>
                                        <input name="email" type="text" value="<?php echo $peg['email']; ?>" hidden></input>
                                        <br>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div> <!-- end card-body -->
                            </div> <!-- end card -->
                        </div> <!-- end col -->
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

    <!-- jQuery -->
    <script src="../assets/js/jquery-latest.min.js"></script>
    <script>
        $(function() {
            $(".checkme").click(function(event) {
                var x = $(this).is(':radio');
                if (x == true) {
                    $(this).parents(".checkbox-card").find('.passport-box').show();
                } else {
                    $(this).parents(".checkbox-card").find('.passport-box').hide();
                }
            });
        })
        $(function() {
            $(".checkre").click(function(event) {
                var x = $(this).is(':radio');
                if (x == true) {
                    $(this).parents(".checkbox-card").find('.passport-box').hide();
                } else {
                    $(this).parents(".checkbox-card").find('.passport-box').show();
                }
            });
        })
    </script>

    <!-- third party js -->
    <script src="../assets/js/vendor/Chart.bundle.min.js"></script>
    <!-- third party js ends -->

    <!-- demo app -->
    <script src="../assets/js/pages/demo.dashboard-projects.js"></script>
    <!-- end demo js-->
    <script>
        var auto_complete = new Autocomplete(document.getElementById('kelurahan'), {
            data: <?php echo json_encode($data); ?>,
            maximumItems: 10,
            highlightTyped: true,
            highlightClass: 'fw-bold text-primary'
        });
    </script>

</body>

</html>