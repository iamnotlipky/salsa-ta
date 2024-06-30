<?php

$brgkeluar = new lsp();

$dataTransaksi = $brgkeluar->select("transaksi_terbaru");


if ($_SESSION['level'] != "Manager" && $_SESSION['level'] != "Admin") {
    header("Location: index.php");
}

if (isset($_GET['delete'])) {
    $response = $brgmasuk->delete("table_barang", "kd_barang", $_GET['id'], "?page=data-barang-masuk");
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
                                <li class="list-inline-item active"><?= $auth['level']; ?></li>
                                <li class="list-inline-item seprate">
                                    <span>/</span>
                                </li>
                                <li class="list-inline-item">Data Barang Keluar</li>
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
                <div class="col-md-12">
                    <div class="card">
                        <div class="au-card-title">
                            <div class="bg-overlay bg-overlay--blue bg-primary"></div>
                            <h3>
                                <i class="zmdi zmdi-account-calendar"></i>Data Barang Keluar
                            </h3>
                        </div>
                        <?php if ($auth['level'] != "Manager") : ?>
                            <div class="m-3">
                                <a href="?page=input-barang-keluar" class="btn btn-primary"><i class="fa fa-plus"></i> Input Barang Keluar</a>
                            </div>
                        <?php endif; ?>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="myDataTables" class="table table-striped table-bordered" style="width:100%">
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
                                                <tr>
                                                    <td><?= $dts['kd_transaksi'] ?></a></td>
                                                    <td><?= $dts['nama_user'] ?></td>
                                                    <td><?= $dts['jumlah_beli'] ?></td>
                                                    <td><?= $dts['total_harga'] ?></td>
                                                    <td><?= $dts['tanggal_beli'] ?></td>
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
                                            <?php endforeach ?>
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
    </div>
</section>