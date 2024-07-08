<?php

$manager = new lsp();
$user       = $manager->selectCount("table_user", "kd_user");
$barang     = $manager->selectCount("table_barang", "kd_barang");
$brgrijek   = $manager->selectCount("table_barang_rijek", "kd_barang");
$transaksi  = $manager->selectCount("table_transaksi", "jumlah_beli");
$dataTransaksi = $manager->select("transaksi_terbaru");

if ($_SESSION['level'] != "Manager") {
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
                        <a href="?page=data-user">
                            <h2 class="number"><?= $user['count']; ?></h2>
                            <span class="desc">User</span>
                            <div class="icon">
                                <i class="zmdi zmdi-accounts-alt"></i>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="statistic__item">
                        <a href="?page=data-barang-masuk">
                            <h2 class="number"><?= $barang['count'] ?></h2>
                            <span class="desc">Barang Masuk</span>
                            <div class="icon">
                                <i class="zmdi zmdi-arrow-left"></i>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="statistic__item">
                        <a href="?page=data-barang-rijek">
                            <h2 class="number"><?= $brgrijek['count']; ?></h2>
                            <span class="desc">Barang Rijek</span>
                            <div class="icon">
                                <i class="zmdi zmdi-store"></i>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="statistic__item">
                        <a href="?page=data-barang-keluar">
                            <h2 class="number"><?= $transaksi['count']; ?></h2>
                            <span class="desc">Barang Keluar</span>
                            <div class="icon">
                                <i class="zmdi zmdi-arrow-right"></i>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="au-card-title">
                            <div class="bg-overlay bg-overlay--blue bg-primary"></div>
                            <h3>
                                <i class="zmdi zmdi-account-calendar"></i>Data Barang Keluar Unapproved
                            </h3>
                        </div>
                        <div class="card-body">
                            <table id="myDataTables" class="table table-responsive table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <td>Kode Transaksi</td>
                                        <td>Nama Penginput</td>
                                        <td>Jumlah Beli</td>
                                        <td>Total Harga</td>
                                        <td>Tanggal Beli</td>
                                        <td>Status</td>
                                        <td>Opsi</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($dataTransaksi)) : ?>
                                        <?php foreach ($dataTransaksi as $dts) : ?>
                                            <?php if ($dts['status'] == "Unapproved") : ?>
                                                <tr>
                                                    <td><?= $dts['kd_transaksi'] ?></td>
                                                    <td><?= $dts['nama_user'] ?></td>
                                                    <td><?= $dts['jumlah_beli'] ?></td>
                                                    <td><?= $dts['total_harga'] ?></td>
                                                    <td><?= date_ind($dts['tanggal_beli']) ?></td>
                                                    <td><?php if ($dts['status'] == "Unapproved") : ?>
                                                            <span class="badge badge-danger">Unapproved</span>
                                                        <?php elseif ($dts['status'] == "Approved") : ?>
                                                            <span class="badge badge-success">Approved</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="?page=surat-jalan&id=<?= $dts['kd_transaksi'] ?>" data-toggle="tooltip" data-placement="top" title="Detail" class="btn btn-warning text-white"><i class="fa fa-search"></i></a>

                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr class="text-center">
                                            <td colspan="5">Tidak Ada Data</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>