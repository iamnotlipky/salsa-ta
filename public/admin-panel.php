<?php

require_once "../config/config.php";
require_once "../functions/functions.php";
require_once "../functions/sessions.php";
require_once "../functions/date.php";

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
                include "includes/global/data-barang-masuk.php";
                break;
            case 'input-barang-masuk':
                include "includes/global/input-barang-masuk.php";
                break;
            case 'view-barang-detail':
                include "includes/global/view-barang-detail.php";
                break;
            case 'data-barang-rijek':
                include "includes/global/data-barang-rijek.php";
                break;
            case 'input-barang-rijek':
                include "includes/global/input-barang-rijek.php";
                break;
            case 'view-detail-barang-rijek':
                include "includes/global/view-detail-barang-rijek.php";
                break;
            case 'view-edit-barang':
                include "includes/admin/view-edit-barang.php";
                break;
            case 'view-edit-barang-rijek':
                include "includes/admin/view-edit-barang-rijek.php";
                break;
            case 'data-barang-keluar':
                include "includes/admin/data-barang-keluar.php";
                break;
            case 'input-barang-keluar':
                include "includes/global/input-barang-keluar.php";
                break;
            case 'data-supplier':
                include "includes/admin/data-supplier.php";
                break;
            case 'data-layout':
                include "includes/admin/data-layout.php";
                break;
            case 'data-satuan':
                include "includes/admin/data-satuan.php";
                break;
            case 'data-layout-barang':
                include "includes/admin/data-layout-barang.php";
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
                include "includes/admin/dashboard.php";
                break;
        }

        ?>

    </div>

</div>

<?php include "templates/footer.php";
