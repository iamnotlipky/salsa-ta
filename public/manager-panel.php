<?php

require_once "../config/config.php";
require_once "../functions/functions.php";
require_once "../functions/sessions.php";
include "templates/header.php";

?>

<div class="page-wrapper">

    <?php include "templates/sidebar.php"; ?>

    <div class="page-container2">

        <?php
        include "templates/navbar.php";

        @$page = $_GET['page'];
        switch ($page) {
            case 'data-barang-masuk':
                include "includes/manager/laporan-semua-barang.php";
                break;
            case 'data-barang-rijek':
                include "includes/manager/laporan-barang-rijek.php";
                break;
            case 'data-barang-keluar':
                include "includes/global/data-barang-keluar.php";
                break;
            case 'laporan-semua-barang':
                include "includes/manager/laporan-semua-barang.php";
                break;
            case 'view-barang-detail':
                include "includes/global/view-barang-detail.php";
                break;
            case 'data-barang-periode':
                include "includes/manager/data-barang-periode.php";
                break;
            case 'data-barang-habis':
                include "includes/manager/data-barang-habis.php";
                break;
            case 'data-user':
                include "includes/manager/data-user.php";
                break;
            case 'cetak-surat-jalan':
                include "includes/admin/cetak-surat-jalan.php";
                break;
            case 'surat-jalan':
                include "includes/admin/surat-jalan.php";
                break;
            case 'profile-setting':
                include "includes/global/profile-setting.php";
                break;
            default:
                $page = "dashboard";
                include "includes/manager/dashboard.php";
                break;
        }

        ?>

    </div>

</div>

<?php include "templates/footer.php"; ?>