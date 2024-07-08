<?php

$brgmasuk = new lsp();

$detailbrg = $brgmasuk->select("detailbarang");

if ($_SESSION['level'] != "Manager" && $_SESSION['level'] != "Admin" && $_SESSION['level'] != "Checker") {
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
                                <li class="list-inline-item">
                                    <?php if ($auth['level'] == "Admin") : ?>
                                        Kelola Barang Masuk
                                    <?php else : ?>
                                        Data Barang Masuk
                                    <?php endif; ?>
                                </li>
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
                                    <?php
                                    $no = 1;
                                    foreach ($detailbrg as $db) {
                                    ?>
                                        <tr>
                                            <td><?= $db['kd_barang'] ?></td>
                                            <td><?= $db['nama_barang'] ?></td>
                                            <td><?= $db['layout'] ?></td>
                                            <td><?= $db['nama_supplier'] ?></td>
                                            <td><?= date_ind($db['tanggal_masuk']) ?></td>
                                            <td><?= number_format($db['harga_barang']) ?></td>
                                            <td><?= $db['stok_barang'] ?></td>
                                            <td><?= $db['satuan'] ?></td>
                                            <td>
                                                <?php if ($db['status'] == "Unapproved") : ?>
                                                    <span class="badge badge-danger">Unapproved</span>
                                                <?php elseif ($db['status'] == "Approved") : ?>
                                                    <span class="badge badge-success">Approved</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <?php if ($_SESSION['level'] != "Checker") : ?>
                                                        <a href="?page=view-edit-barang&edit&id=<?= $db['kd_barang'] ?>" data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                                        <button data-toggle="tooltip" data-placement="top" title="Delete" class="btn btn-danger">
                                                            <i class="fa fa-trash" id="button-delete<?php echo $no; ?>"></i>
                                                        </button>
                                                    <?php endif; ?>
                                                    <a href="?page=view-barang-detail&id=<?php echo $db['kd_barang'] ?>" data-toggle="tooltip" data-placement="top" title="Detail" class="btn btn-warning text-white"><i class="fa fa-search"></i></a>
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
                                                        window.location.href = "?page=data-barang-masuk&delete&id=<?php echo $db['kd_barang'] ?>";
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
</section>