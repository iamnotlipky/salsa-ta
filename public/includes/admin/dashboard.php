<?php

$admin = new lsp();
$supplier   = $admin->getCountRows("table_supplier");
$user       = $admin->selectCount("table_user", "kd_user");
$barang     = $admin->selectCount("table_barang", "kd_barang");
$transaksi  = $admin->selectCount("table_transaksi", "jumlah_beli");

if ($_SESSION['level'] != "Admin") {
    header("location:index.php");
}

?>

<section class="au-breadcrumb m-t-75">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="au-breadcrumb-content">
                        <div class="au-breadcrumb-left">
                            <ul class="list-unstyled list-inline au-breadcrumb__list">
                                <li class="list-inline-item active">
                                    <a href="#"><?= $auth['level']; ?></a>
                                </li>
                                <li class="list-inline-item seprate">
                                    <span>/</span>
                                </li>
                                <li class="list-inline-item">Dashboard</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="statistic">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-lg-3">
                    <div class="statistic__item">
                        <h2 class="number"><?= $user['count']; ?></h2>
                        <span class="desc">User</span>
                        <div class="icon">
                            <i class="zmdi zmdi-accounts-alt"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="statistic__item">
                        <h2 class="number"><?= $supplier; ?></h2>
                        <span class="desc">Supplier</span>
                        <div class="icon">
                            <i class="zmdi zmdi-store"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="statistic__item">
                        <h2 class="number"><?= $barang['count'] ?></h2>
                        <span class="desc">Barang Tersedia</span>
                        <div class="icon">
                            <i class="zmdi zmdi-chart"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="statistic__item">
                        <h2 class="number"><?= $transaksi['count']; ?></h2>
                        <span class="desc">Barang Keluar</span>
                        <div class="icon">
                            <i class="zmdi zmdi-arrow-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>