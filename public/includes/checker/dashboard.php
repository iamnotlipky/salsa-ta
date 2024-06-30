<?php

$checker = new lsp();
$pegawai = $checker->selectCount("table_user", "kd_user");
$bm  = $checker->selectCount("table_barang", "kd_barang");
$br   = $checker->selectCount("table_barang_rijek", "kd_barang");
$berhasil = $checker->selectCount("table_transaksi", "kd_transaksi");

$dataB = $checker->select("detailbarang");

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
                        <h2 class="number"><?= $bm['count'] ?></h2>
                        <span class="desc">Barang Masuk</span>
                        <div class="icon">
                            <i class="zmdi zmdi-arrow-left"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="statistic__item">
                        <h2 class="number"><?= $br['count']; ?></h2>
                        <span class="desc">Barang Rijek</span>
                        <div class="icon">
                            <i class="zmdi zmdi-arrow-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>