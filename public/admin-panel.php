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
            case 'input-barang-masuk':
                include "includes/global/input-barang-masuk.php";
                break;
            case 'data-barang-masuk':
                include "includes/global/data-barang-masuk.php";
                break;
            case 'view-barang-detail':
                include "includes/global/view-barang-detail.php";
                break;
            case 'view-edit-barang':
                include "includes/admin/view-edit-barang.php";
                break;
            case 'data-barang-keluar':
                include "includes/global/data-barang-keluar.php";
                break;
            case 'input-barang-keluar':
                include "includes/global/input-barang-keluar.php";
                break;
            case 'data-user':
                include "includes/admin/data-user.php";
                break;
            case 'data-supplier':
                include "includes/admin/data-supplier.php";
                break;
            case 'data-lokasi':
                include "includes/admin/data-lokasi.php";
                break;
            case 'data-satuan':
                include "includes/admin/data-satuan.php";
                break;
            case 'data-lokasi-barang':
                include "includes/admin/data-lokasi-barang.php";
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
