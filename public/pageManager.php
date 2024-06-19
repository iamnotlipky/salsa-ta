<?php

include "config/config.php";

$function = new lsp();
session_start();

$auth = $function->AuthUser($_SESSION['username']);


$response = $function->sessionCheck();
if ($response == "false") {
    header("Location:index.php");
}
if (isset($_GET['logout'])) {
    $function->logout();
}

?>

<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title><?= $auth['level'] ?> Warehouse PT SID Cabang Tegal</title>

    <!-- Fontfaces CSS-->
    <link href="assets/css/font-face.css" rel="stylesheet" media="all">
    <link href="assets/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="assets/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="assets/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="assets/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="assets/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="assets/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="assets/vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="assets/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="assets/vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="assets/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="assets/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
    <link href="assets/vendor/vector-map/jqvmap.min.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="assets/css/sweet-alert.css">

    <!-- Main CSS-->
    <link href="assets/css/theme.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">

    <!-- Website Icon -->
    <link href="assets/img/icon/icon.png" rel="icon">
    <link href="assets/img/icon/icon.png" rel="apple-touch-icon">

</head>

<body>

    <div class="page-wrapper">
        <aside class="menu-sidebar2">
            <div class="logo">
                <a href="?page">
                    <img src="assets/img/icon/logo.png" alt="Logo" />
                </a>
            </div>
            <div class="menu-sidebar2__content js-scrollbar1">
                <div class="account2">
                    <div class="image img-cir img-120">
                        <img src="img/<?= $auth['foto_user'] ?>" />
                    </div>
                    <h4 class="name"><?= $auth['nama_user']; ?></h4>
                    <span><?= $auth['level']; ?></span>
                </div>
                <nav class="navbar-sidebar2">
                    <ul class="list-unstyled navbar__list">
                        <li>
                            <a href="?page">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>
                        <li>
                            <a href="?page=kelPegawai">
                                <i class="fas fa-users"></i>Kelola Pegawai</a>
                        </li>
                        <li>
                            <a href="?page=kelTransaksi">
                                <i class="fas fa-shopping-basket"></i>Data Barang Keluar</a>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-archive"></i>Data Barang</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="?page=kelBarang">Semua Barang</a>
                                </li>
                                <li>
                                    <a href="?page=periode">Lihat Barang per Periode</a>
                                </li>
                                <li>
                                    <a href="?page=barangHabis">Barang Habis</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="page-container2">
            <header class="header-desktop2 hd">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap2">
                            <div class="logo d-block d-lg-none w-50">
                                <a href="#">
                                    <img src="assets/img/icon/logo.png" alt="Logo" />
                                </a>
                            </div>
                            <div class="header-button2">
                                <div class="header-button-item mr-0 js-sidebar-btn">
                                    <i class="zmdi zmdi-menu"></i>
                                </div>
                                <div class="setting-menu js-right-sidebar d-none d-lg-block">
                                    <div class="account-dropdown__body">
                                        <div class="account-dropdown__item">
                                            <a href="?page=profil">
                                                <i class="zmdi zmdi-account"></i>Profil</a>
                                        </div>
                                        <div class="account-dropdown__item">
                                            <a href="homepage.php?logout" id="forLogout">
                                                <i class="zmdi zmdi-power"></i>Keluar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <aside class="menu-sidebar2 js-right-sidebar d-block d-lg-none">
                <div class="logo">
                    <a href="?page">
                        <img src="assets/img/icon/logo.png" alt="Logo" />
                    </a>
                </div>
                <div class="menu-sidebar2__content js-scrollbar2">
                    <div class="account2">
                        <div class="image img-cir img-120">
                            <img src="img/<?= $auth['foto_user'] ?>" alt="User" />
                        </div>
                        <h4 class="name"><?= $auth['nama_user'] ?></h4>
                        <span><?= $auth['level'] ?></span>
                    </div>
                    <nav class="navbar-sidebar2">
                        <ul class="list-unstyled navbar__list">
                            <li>
                                <a href="?page"><i class="fas fa-tachometer-alt"></i>Dashboard</a>
                            </li>
                            <li>
                                <a href="?page=kelPegawai"><i class="fas fa-users"></i>Kelola Pegawai</a>
                            </li>
                            <li>
                                <a href="?page=kelTransaksi"><i class="fas fa-shopping-basket"></i>Data Barang Keluar</a>
                            </li>
                            <li class="has-sub">
                                <a class="js-arrow" href="#"><i class="fas fa-tachometer-alt"></i>Data Barang</a>
                                <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                    <li>
                                        <a href="?page=kelBarang">Semua Barang</a>
                                    </li>
                                    <li>
                                        <a href="?page=periode">Lihat Barang per Periode</a>
                                    </li>
                                    <li>
                                        <a href="?page=barangHabis">Barang Habis</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="homepage.php?logout" id="forLogout"><i class="fas fa-sign-out-alt"></i>Keluar</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </aside>

            <?php

            @$page = $_GET['page'];
            switch ($page) {
                case 'kelPegawai':
                    include "pages/manager/kelolaPegawai.php";
                    break;
                case 'profil':
                    include "pages/profil.php";
                    break;
                case 'kelBarang':
                    include "pages/manager/viewManagerBarang.php";
                    break;
                case 'viewBarangDetail':
                    include "pages/manager/viewBarangDetail.php";
                    break;
                case 'periode':
                    include "pages/manager/BarangPeriode.php";
                    break;
                case 'barangHabis':
                    include "pages/manager/BarangHabis.php";
                    break;
                case 'kelTransaksi':
                    include "pages/manager/Transaksi.php";
                    break;
                default:
                    $page = "dashboard";
                    include "pages/manager/dashboard.php";
                    break;
            }

            ?>

        </div>

    </div>

    <!-- Jquery JS-->
    <script src="assets/vendor/jquery-3.2.1.min.js"></script>
    <script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Bootstrap JS-->
    <script src="assets/vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="assets/vendor/bootstrap-4.1/bootstrap.min.js"></script>

    <!-- Vendor JS-->
    <script src="assets/vendor/slick/slick.min.js"></script>
    <script src="assets/vendor/wow/wow.min.js"></script>
    <script src="assets/vendor/animsition/animsition.min.js"></script>
    <script src="assets/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <script src="assets/vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="assets/vendor/counter-up/jquery.counterup.min.js"></script>
    <script src="assets/vendor/circle-progress/circle-progress.min.js"></script>
    <script src="assets/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="assets/vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="assets/vendor/select2/select2.min.js"></script>
    <script src="assets/vendor/vector-map/jquery.vmap.js"></script>
    <script src="assets/vendor/vector-map/jquery.vmap.min.js"></script>
    <script src="assets/vendor/vector-map/jquery.vmap.sampledata.js"></script>
    <script src="assets/vendor/vector-map/jquery.vmap.world.js"></script>

    <!-- Main JS-->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/sweetalert.min.js"></script>
    <script src="assets/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(document).ready(function() {
            function preview(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#pict').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }
            $('#gambar').change(function() {
                preview(this);
            })
        });
    </script>
    <script>
        $(document).ready(function() {
            function preview(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#pict2').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }
            $('#gambar2').change(function() {
                preview(this);
            })
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#forLogout').click(function(e) {
                e.preventDefault();
                swal({
                    title: "Keluar",
                    text: "Keluar dari Halaman Manager?",
                    type: "info",
                    showCancelButton: true,
                    confirmButtonText: "Konfirmasi",
                    cancelButtonText: "Tidak",
                    closeOnConfirm: false,
                    closeOnCancel: true
                }, function(isConfirm) {
                    if (isConfirm) {
                        window.location.href = "?logout";
                    }
                });
            });
        })
    </script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
    <?php include "others/alert.php"; ?>
</body>

</html>