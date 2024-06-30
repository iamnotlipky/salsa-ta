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
            case 'profile-setting':
                include "includes/global/profile-setting.php";
                break;
            default:
                $page = "dashboard";
                include "includes/checker/dashboard.php";
                break;
        }

        ?>

    </div>

</div>

<?php include "templates/footer.php"; ?>