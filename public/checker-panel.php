<?php

require_once "../config/config.php";
require_once "../functions/functions.php";

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

include "templates/header.php";

?>

<div class="page-wrapper">
    <!-- Menu Sidebar -->
    <aside class="menu-sidebar2">
        <div class="logo">
            <a href="?page">
                <img src="assets/img/icon/logo.png" alt="logo" class="w-100" />
            </a>
        </div>
        <div class="menu-sidebar2__content js-scrollbar1">
            <div class="account2">
                <div class="image img-cir img-120">
                    <img src="img/<?= $auth['foto_user'] ?>" alt="user-image" class="image-sid" />
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
                        <a href="?page=view-barang-masuk">
                            <i class="fas fa-archive"></i>Data Barang Masuk</a>
                    </li>
                    <li>
                        <a href="?page=checkerTransaksi">
                            <i class="fas fa-shopping-basket"></i>Data Barang Keluar</a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>
    <!-- End Menu Sidebar -->

    <!-- Page Container -->
    <div class="page-container2">
        <header class="header-desktop2">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="header-wrap2">
                        <div class="logo d-block d-lg-none rounded">
                            <a href="#">
                                <img src="assets/img/icon/logo.png" alt="logo" class="w-100" />
                            </a>
                        </div>
                        <div class="header-button2">
                            <div class="header-button-item mr-0 js-sidebar-btn">
                                <i class="zmdi zmdi-menu"></i>
                            </div>
                            <div class="setting-menu js-right-sidebar d-none d-lg-block">
                                <div class="account-dropdown__body">
                                    <div class="account-dropdown__item">
                                        <a href="?page=profile-setting">
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
                    <img src="assets/img/icon/logo.png" alt="logo" class="w-100" />
                </a>
            </div>
            <div class="menu-sidebar2__content js-scrollbar2">
                <div class="account2">
                    <div class="image img-cir img-120">
                        <img src="img/<?= $auth['foto_user'] ?>" alt="user-image" class="image-sid" />
                    </div>
                    <h4 class="name"><?= $auth['nama_user'] ?></h4>
                    <span><?= $auth['level'] ?></span>
                </div>
                <nav class="navbar-sidebar2">
                    <ul class="list-unstyled navbar__list">
                        <li>
                            <a href="?page">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>
                        <li>
                            <a href="?page=view-barang-masuk"><i class="fas fa-archive"></i>Data Barang Masuk</a>
                        </li>
                        <li>
                            <a href="?page=checkerTransaksi">
                                <i class="fas fa-shopping-basket"></i>Data Barang Keluar</a>
                        </li>
                        <li>
                            <a href="?page=profile-setting">
                                <i class="fas fa-gear"></i>Profil</a>
                        </li>
                        <li>
                            <a href="homepage.php?logout" id="forLogout">
                                <i class="fas fa-sign-out-alt"></i>Keluar</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <?php
        @$page = $_GET['page'];
        switch ($page) {
            case 'profile-setting':
                include "includes/global/profile-setting.php";
                break;
            case 'view-barang-masuk':
                include "includes/checker/view-barang-masuk.php";
                break;
            case 'add-barang-masuk':
                include "includes/global/add-barang-masuk.php";
                break;
            case 'viewBarangDetail':
                include "includes/checker/viewBarangDetail.php";
                break;
            case 'viewBarangEdit':
                include "includes/checker/viewBarangEdit.php";
                break;
            case 'checkerTransaksi':
                include "includes/checker/view-barang-keluar.php";
                break;
            case 'checkerPembayaran':
                include "includes/checker/checkerPembayaran.php";
                break;
            case 'struk':
                include "includes/checker/strukTransaksi.php";
                break;
            default:
                $page = "dashboard";
                include "includes/checker/dashboard.php";
                break;
        }
        ?>

    </div>
    <!-- End Page Container -->

</div>

<?php include "templates/footer.php"; ?>