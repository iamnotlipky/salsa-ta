<?php

$pg = new lsp();
$pegawai = $pg->selectCount("table_user", "kd_user");
$barang  = $pg->selectCount("table_barang", "kd_barang");
$berhasil = $pg->selectCount("table_transaksi", "kd_transaksi");
$assoc1   = $pg->selectCount("table_transaksi", "jumlah_beli");

$dataB = $pg->select("detailbarang");

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
                        <h2 class="number"><?= $barang['count'] ?></h2>
                        <span class="desc">Barang Tersedia</span>
                        <div class="icon">
                            <i class="zmdi zmdi-chart"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
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

<section>
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="au-card-title">
                            <div class="bg-overlay bg-overlay--blue bg-primary"></div>
                            <h3>
                                <i class="zmdi zmdi-account-calendar"></i> Data Barang Masuk
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="myDataTables" class="table table-borderless table-striped">
                                    <thead>
                                        <tr>
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Lokasi Barang</th>
                                            <th>Supplier</th>
                                            <th>Satuan</th>
                                            <th>Tanggal Masuk</th>
                                            <th>Harga</th>
                                            <th>Stok</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($dataB as $ds) {
                                        ?>
                                            <tr>
                                                <td><?= $ds['kd_barang'] ?></td>
                                                <td><?= $ds['nama_barang'] ?></td>
                                                <td><?= $ds['lokasi'] ?></td>
                                                <td><?= $ds['nama_supplier'] ?></td>
                                                <td><?= $ds['satuan'] ?></td>
                                                <td><?= $ds['tanggal_masuk'] ?></td>
                                                <td><?= number_format($ds['harga_barang']) ?></td>
                                                <td><?= $ds['stok_barang'] ?></td>
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <a href="?page=view-barang-detail&id=<?php echo $ds['kd_barang'] ?>" data-toggle="tooltip" data-placement="top" title="Detail" class="btn btn-warning"><i class="fa fa-search"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <script src="../../assets/vendor/jquery-3.2.1.min.js"></script>
                                            <script>
                                                $('#btdelete<?php echo $no; ?>').click(function(e) {
                                                    e.preventDefault();
                                                    swal({
                                                        title: "Hapus",
                                                        text: "Yakin Untuk Menghapus?",
                                                        type: "warning",
                                                        showCancelButton: true,
                                                        confirmButtonText: "Konfirmasi",
                                                        cancelButtonText: "Batal",
                                                        closeOnConfirm: false,
                                                        closeOnCancel: true
                                                    }, function(isConfirm) {
                                                        if (isConfirm) {
                                                            window.location.href = "?page=view-barang-masuk&delete&id=<?php echo $ds['kd_barang'] ?>";
                                                        }
                                                    });
                                                });
                                            </script>
                                        <?php $no++;
                                        } ?>
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