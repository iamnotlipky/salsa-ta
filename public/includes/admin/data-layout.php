<?php
$me       = new lsp();
if ($_SESSION['level'] != "Admin") {
    header("location:index.php");
}
$table    = "table_layout";
$dataLayout  = $me->select($table);
$autokode = $me->autokode($table, "kd_layout", "LI");

if (isset($_GET['delete'])) {
    $id       = $_GET['id'];
    $cek      = $me->selectCountWhere("table_barang", "kd_barang", "kd_layout='$id'");

    if ($cek['count'] > 0) {
        $response = ['response' => 'negative', 'alert' => 'Layout sudah dipakai pada barang, tidak dapat dihapus!'];
    } else {
        $where    = "kd_layout";
        $response = $me->delete($table, $where, $id, "?page=data-layout");
    }
}

if (isset($_POST['getSave'])) {
    $kode_layout = $me->validateHtml($_POST['kode_layout']);
    $layout      = $me->validateHtml($_POST['layout']);

    if ($kode_layout == "" || $layout == "") {
        $response = ['response' => 'negative', 'alert' => 'Lengkapi Formulir!'];
    } else {
        $value    = "'$kode_layout','$layout'";
        $response = $me->insert($table, $value, "?page=data-layout");
    }
}

if (isset($_POST['getUpdate'])) {
    $kode_layout = $me->validateHtml($_POST['kode_layout']);
    $layout      = $me->validateHtml($_POST['layout']);

    $value = "kd_layout='$kode_layout',layout='$layout'";
    $response = $me->update($table, $value, "kd_layout", $_GET['id'], "?page=data-layout");
}

if (isset($_GET['edit'])) {
    $editData = $me->selectWhere($table, "kd_layout", $_GET['id']);
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
                                <li class="list-inline-item">Kelola Data Layout</li>
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
                            <strong class="card-title mb-3">Input Data Layout</strong>
                        </div>
                        <div class="card-body">
                            <form method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="">Kode Layout</label>
                                    <?php if (!isset($_GET['edit'])) : ?>
                                        <input type="text" class="form-control form-control-sm" name="kode_layout" style="font-weight: bold; color: red;" value="<?php echo $autokode; ?>" readonly>
                                    <?php endif ?>
                                    <?php if (isset($_GET['edit'])) : ?>
                                        <input type="text" class="form-control form-control-sm" name="kode_layout" style="font-weight: bold; color: red;" value="<?php echo @$editData['kd_layout']; ?>" readonly>
                                    <?php endif ?>
                                </div>
                                <div class="form-group">
                                    <label for="">Nama Layout</label>
                                    <input type="text" class="form-control form-control-sm" name="layout" value="<?php echo @$editData['layout'] ?>">
                                </div>
                                <hr>
                                <?php if (isset($_GET['edit'])) : ?>
                                    <button type="submit" name="getUpdate" class="btn btn-primary"><i class="fa fa-check"></i> Konfirmasi</button>
                                    <a href="?page=data-layout" class="btn btn-danger">Batal</a>
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
                            <strong class="card-title mb-3">Data Layout</strong>
                        </div>
                        <div class="card-body">
                            <table id="myDataTables" class="table table-responsive table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <td>Kode Layout</td>
                                        <td>Nama Layout</td>
                                        <td>Opsi</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($dataLayout as $ds) {
                                    ?>
                                        <tr>
                                            <td><?= $ds['kd_layout'] ?></td>
                                            <td><?= $ds['layout'] ?></td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a data-toggle="tooltip" data-placement="top" title="Edit" href="?page=data-layout&edit&id=<?= $ds['kd_layout'] ?>" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                                    <button data-toggle="tooltip" data-placement="top" title="Hapus" class="btn btn-danger"><i class="fa fa-trash" id="btnDelete<?php echo $no; ?>"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                        <script src="assets/vendor/jquery-3.2.1.min.js"></script>
                                        <script>
                                            $('#btnDelete<?php echo $no; ?>').click(function(e) {
                                                e.preventDefault();
                                                swal({
                                                    title: "Hapus",
                                                    text: "Yakin Untuk Menghapus?",
                                                    type: "error",
                                                    showCancelButton: true,
                                                    confirmButtonText: "Konfirmasi",
                                                    cancelButtonText: "Batal",
                                                    closeOnConfirm: false,
                                                    closeOnCancel: true
                                                }, function(isConfirm) {
                                                    if (isConfirm) {
                                                        window.location.href = "?page=data-layout&delete&id=<?php echo $ds['kd_layout'] ?>";
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