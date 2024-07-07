<?php

$admin = new lsp();
$supplier   = $admin->getCountRows("table_supplier");
$barang     = $admin->selectCount("table_barang", "kd_barang");
$brgrijek   = $admin->selectCount("table_barang_rijek", "kd_barang");
$transaksi  = $admin->selectCount("table_transaksi", "jumlah_beli");

$detailbrg = $admin->select("detailbarang");
$detailbrgrijek = $admin->select("detailbarangrijek");


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
                        <a href="?page=data-supplier">
                            <h2 class="number"><?= $supplier; ?></h2>
                            <span class="desc">Supplier</span>
                            <div class="icon">
                                <i class="zmdi zmdi-store"></i>
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
                                <i class="zmdi zmdi-block"></i>
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
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="au-card-title">
                            <div class="bg-overlay bg-overlay--blue bg-primary"></div>
                            <h3>
                                <i class="zmdi zmdi-account-calendar"></i>Data Barang Unapproved
                            </h3>
                        </div>
                        <div class="card-body">
                            <table id="myDataTables" class="table table-responsive table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <td>Kode Barang</td>
                                        <td>Nama Barang</td>
                                        <td>Layout</td>
                                        <td>Supplier</td>
                                        <td>Tanggal Masuk</td>
                                        <td>Harga</td>
                                        <td>Stok</td>
                                        <td>Satuan</td>
                                        <td>Status</td>
                                        <td>Opsi</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($detailbrg as $db) : ?>
                                        <?php if ($db['status'] == "Unapproved") : ?>
                                            <tr>
                                                <td><?= $db['kd_barang'] ?></td>
                                                <td><?= $db['nama_barang'] ?></td>
                                                <td><?= $db['layout'] ?></td>
                                                <td><?= $db['nama_supplier'] ?></td>
                                                <td><?= $db['tanggal_masuk'] ?></td>
                                                <td><?= number_format($db['harga_barang']) ?></td>
                                                <td><?= $db['stok_barang'] ?></td>
                                                <td><?= $db['satuan'] ?></td>
                                                <td>
                                                    <?php if ($db['status'] == "Unapproved") : ?>
                                                        <span class="badge badge-danger">Unapproved</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <a href="?page=view-barang-detail&id=<?php echo $db['kd_barang'] ?>" data-toggle="tooltip" data-placement="top" title="Detail" class="btn btn-warning text-white"><i class="fa fa-search"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                    <?php foreach ($detailbrgrijek as $dbr) : ?>
                                        <?php if ($dbr['status'] == "Unapproved") : ?>
                                            <tr>
                                                <td><?= $dbr['kd_barang'] ?></td>
                                                <td><?= $dbr['nama_barang'] ?></td>
                                                <td><?= $dbr['layout'] ?></td>
                                                <td><?= $dbr['nama_supplier'] ?></td>
                                                <td><?= $dbr['tanggal_masuk'] ?></td>
                                                <td><?= number_format($dbr['harga_barang']) ?></td>
                                                <td><?= $dbr['stok_barang'] ?></td>
                                                <td><?= $dbr['satuan'] ?></td>
                                                <td>
                                                    <?php if ($dbr['status'] == "Unapproved") : ?>
                                                        <span class="badge badge-danger">Unapproved</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <a href="?page=view-detail-barang-rijek&id=<?php echo $dbr['kd_barang'] ?>" data-toggle="tooltip" data-placement="top" title="Detail" class="btn btn-warning text-white"><i class="fa fa-search"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>