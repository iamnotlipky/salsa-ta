<?php
$pg = new lsp();
$pegawai = $pg->selectCount("table_user", "kd_user");
$barang  = $pg->selectCount("table_barang", "kd_barang");
$berhasil = $pg->selectCount("table_transaksi", "kd_transaksi");
$assoc1   = $pg->selectCount("table_transaksi", "jumlah_beli");
?>

<!-- BREADCRUMB-->
<section class="au-breadcrumb m-t-75">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="au-breadcrumb-content">
                        <div class="au-breadcrumb-left">
                            <span class="au-breadcrumb-span">You are here:</span>
                            <ul class="list-unstyled list-inline au-breadcrumb__list">
                                <li class="list-inline-item active">
                                    <a href="#">Home</a>
                                </li>
                                <li class="list-inline-item seprate">
                                    <span>/</span>
                                </li>
                                <li class="list-inline-item">Dashboard</li>
                            </ul>
                        </div>
                        <a href="?page=checkerTransaksi" class="au-btn au-btn-icon au-btn--green">
                            <i class="zmdi zmdi-plus"></i>add item
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END BREADCRUMB-->

<!-- STATISTIC-->
<section class="statistic">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-lg-6">
                    <div class="statistic__item">
                        <h2 class="number"><?= $barang['count'] ?></h2>
                        <span class="desc">Barang Tersedia</span>
                        <div class="icon">
                            <i class="zmdi zmdi-chart"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6">
                    <div class="statistic__item">
                        <h2 class="number"><?= $assoc1['count']; ?></h2>
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
<!-- END STATISTIC-->