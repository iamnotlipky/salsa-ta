<?php

$qb = new lsp();

$dataB = $qb->select("detailbarang");

if ($_SESSION['level'] != "Manager" && $_SESSION['level'] != "Admin") {
    header("location:index.php");
}

if (isset($_GET['delete'])) {
    $response = $qb->delete("table_barang", "kd_barang", $_GET['id'], "?page=data-barang-masuk");
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
                                <li class="list-inline-item">Data Barang Masuk</li>
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
                                <i class="zmdi zmdi-account-calendar"></i>Data Barang Masuk
                            </h3>
                        </div>
                        <?php if ($auth['level'] != "Manager") : ?>
                            <div class="m-3">
                                <a href="?page=input-barang-masuk" class="btn btn-primary"><i class="fa fa-plus"></i> Input Barang Masuk</a>
                            </div>
                        <?php endif; ?>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="myDataTables" class="table table-borderless table-striped">
                                    <thead>
                                        <tr>
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Lokasi Barang</th>
                                            <th>Satuan</th>
                                            <th>Supplier</th>
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
                                                <td><?= $ds['satuan'] ?></td>
                                                <td><?= $ds['nama_supplier'] ?></td>
                                                <td><?= $ds['tanggal_masuk'] ?></td>
                                                <td><?= number_format($ds['harga_barang']) ?></td>
                                                <td><?= $ds['stok_barang'] ?></td>
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <a href="?page=view-edit-barang&edit&id=<?= $ds['kd_barang'] ?>" data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                                        <button data-toggle="tooltip" data-placement="top" title="Delete" class="btn btn-danger">
                                                            <i class="fa fa-trash" id="button-delete<?php echo $no; ?>"></i>
                                                        </button>
                                                        <a href="?page=view-barang-detail&id=<?php echo $ds['kd_barang'] ?>" data-toggle="tooltip" data-placement="top" title="Detail" class="btn btn-warning"><i class="fa fa-search"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <script src="assets/vendor/jquery-3.2.1.min.js"></script>
                                            <script>
                                                $('#button-delete<?php echo $no; ?>').click(function(e) {
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
                                                            window.location.href = "?page=data-barang-masuk&delete&id=<?php echo $ds['kd_barang'] ?>";
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