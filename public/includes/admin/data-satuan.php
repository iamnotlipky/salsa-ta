<?php

$sat = new lsp();
if ($_SESSION['level'] != "Admin") {
    header("location:index.php");
}

$table = "table_satuan";
$dataSat = $sat->select($table);
$autokode = $sat->autokode($table, "kd_satuan", "ST");

if (isset($_GET['delete'])) {
    $id       = $_GET['id'];
    $cek      = $sat->selectCountWhere("table_barang", "kd_barang", "kd_satuan='$id'");

    if ($cek['count'] > 0) {
        $response = ['response' => 'negative', 'alert' => 'Satuan sudah dipakai pada barang, tidak dapat dihapus!'];
    } else {
        $where    = "kd_satuan";
        $response = $sat->delete($table, $where, $id, "?page=data-satuan");
    }
}

if (isset($_GET['edit'])) {
    $id = $_GET['id'];
    $editData = $sat->selectWhere($table, "kd_satuan", $id);
    $autokode = $editData['kd_satuan'];
}
if (isset($_POST['getSave'])) {
    $kd_satuan    = $sat->validateHtml($_POST['kode_satuan']);
    $satuan  = $sat->validateHtml($_POST['satuan']);

    if ($kd_satuan == " " || empty($kd_satuan) || $satuan == " " || empty($satuan)) {
        $response = ['response' => 'negative', 'alert' => 'Lengkapi formulir data satuan.'];
    } else {
        $value = "'$kd_satuan','$satuan'";
        $response = $sat->insert($table, $value, "?page=data-satuan");
    }
}

if (isset($_POST['getUpdate'])) {
    $kd_satuan    = $sat->validateHtml($_POST['kode_satuan']);
    $satuan  = $sat->validateHtml($_POST['satuan']);

    if ($kd_satuan == "" || $satuan == "") {
        $response = ['response' => 'negative', 'alert' => 'Lengkapi formulir data satuan.'];
    } else {
        $value = "kd_satuan='$kd_satuan',satuan='$satuan'";
        $response = $sat->update($table, $value, "kd_satuan", $_GET['id'], "?page=data-satuan");
    }
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
                                    <a href="#">Admin</a>
                                </li>
                                <li class="list-inline-item seprate">
                                    <span>/</span>
                                </li>
                                <li class="list-inline-item">Kelola Data Satuan</li>
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
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title mb-3">Input Data Satuan</strong>
                        </div>
                        <div class="card-body">
                            <form method="post">
                                <div class="form-group">
                                    <label for="">Kode Satuan</label>
                                    <input type="text" class="form-control form-control-sm" name="kode_satuan" style="font-weight: bold; color: red;" value="<?php echo $autokode; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Nama Satuan</label>
                                    <input type="text" class="form-control form-control-sm" name="satuan" value="<?php echo @$editData['satuan'] ?>" placeholder="Masukkan Satuan">
                                </div>
                                <?php if (isset($_GET['edit'])) : ?>
                                    <button type="submit" name="getUpdate" class="btn btn-primary"><i class="fa fa-check"></i> Konfirmasi</button>
                                    <a href="?page=data-satuan" class="btn btn-danger"> <i class="fa fa-repeat"></i> Batal</a>
                                <?php endif ?>
                                <?php if (!isset($_GET['edit'])) : ?>
                                    <button type="submit" name="getSave" class="btn btn-primary"><i class="fa fa-download"></i> Simpan</button>
                                    <button type="reset" class="btn btn-danger"><i class="fa fa-eraser"></i> Reset</button>
                                <?php endif ?>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title mb-3">Data Satuan</strong>
                        </div>
                        <div class="card-body">
                            <table id="myDataTables" class="table table-responsive table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Kode satuan</th>
                                        <th>Nama Satuan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($dataSat as $ds) {
                                    ?>
                                        <tr>
                                            <td><?= $ds['kd_satuan'] ?></td>
                                            <td><?= $ds['satuan'] ?></td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a data-toggle="tooltip" data-placement="top" title="Edit" href="?page=data-satuan&edit&id=<?= $ds['kd_satuan'] ?>" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                                    <a data-toggle="tooltip" data-placement="top" title="Delete" href="#" class="btn btn-danger"><i class="fa fa-trash" id="btnDelete<?php echo $no; ?>"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <script src="assets/vendor/jquery-3.2.1.min.js"></script>
                                        <script>
                                            $('#btnDelete<?php echo $no; ?>').click(function(e) {
                                                e.preventDefault();
                                                swal({
                                                    title: "Hapus",
                                                    text: "Hapus Data Satuan?",
                                                    type: "error",
                                                    showCancelButton: true,
                                                    confirmButtonText: "Konfirmasi",
                                                    cancelButtonText: "Batal",
                                                    closeOnConfirm: false,
                                                    closeOnCancel: true
                                                }, function(isConfirm) {
                                                    if (isConfirm) {
                                                        window.location.href = "?page=data-satuan&delete&id=<?php echo $ds['kd_satuan'] ?>";
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
    </se>
    </div>