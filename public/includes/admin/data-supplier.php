<?php

$dis = new lsp();
if ($_SESSION['level'] != "Admin") {
    header("location:index.php");
}

$table = "table_supplier";
$dataDis = $dis->select($table);
$autokode = $dis->autokode($table, "kd_supplier", "SP");

if (isset($_GET['delete'])) {
    $id       = $_GET['id'];
    $cek      = $dis->selectCountWhere("table_barang", "kd_barang", "kd_supplier='$id'");

    if ($cek['count'] > 0) {
        $response = ['response' => 'negative', 'alert' => 'Supplier sudah dipakai pada barang, tidak dapat dihapus!'];
    } else {
        $where    = "kd_supplier";
        $response = $dis->delete($table, $where, $id, "?page=data-supplier");
    }
}

if (isset($_GET['edit'])) {
    $id = $_GET['id'];
    $editData = $dis->selectWhere($table, "kd_supplier", $id);
    $autokode = $editData['kd_supplier'];
}
if (isset($_POST['getSave'])) {
    $kd_supplier    = $dis->validateHtml($_POST['kode_supplier']);
    $nama_supplier  = $dis->validateHtml($_POST['nama_supplier']);
    $nohp_supplier  = $dis->validateHtml($_POST['nohp_supplier']);
    $alamat         = $dis->validateHtml($_POST['alamat']);

    if ($kd_supplier == " " || empty($kd_supplier) || $nama_supplier == " " || empty($nama_supplier) || $nohp_supplier == " " || empty($nohp_supplier) || $alamat == " " || empty($alamat)) {
        $response = ['response' => 'negative', 'alert' => 'Lengkapi formulir data supplier.'];
    } else {
        $validno = substr($nohp_supplier, 0, 1);
        if ($validno != "0") {
            $response = ['response' => 'negative', 'alert' => 'Masukan nomor telepon yang valid.'];
        } else {
            if (strlen($nohp_supplier) < 9) {
                $response = ['response' => 'negative', 'alert' => 'Masukan nomor telepon yang valid.'];
            } else {
                $value = "'$kd_supplier','$nama_supplier','$alamat','$nohp_supplier'";
                $response = $dis->insert($table, $value, "?page=data-supplier");
            }
        }
    }
}

if (isset($_POST['getUpdate'])) {
    $kd_supplier    = $dis->validateHtml($_POST['kode_supplier']);
    $nama_supplier  = $dis->validateHtml($_POST['nama_supplier']);
    $nohp_supplier  = $dis->validateHtml($_POST['nohp_supplier']);
    $alamat         = $dis->validateHtml($_POST['alamat']);

    if ($kd_supplier == "" || $nama_supplier == "" || $nohp_supplier == "" || $alamat == "") {
        $response = ['response' => 'negative', 'alert' => 'Lengkapi formulir data supplier.'];
    } else {
        $validno = substr($nohp_supplier, 0, 1);
        if ($validno != "0") {
            $response = ['response' => 'negative', 'alert' => 'Masukan nomor telepon yang valid.'];
        } else {
            if (strlen($nohp_supplier) < 9) {
                $response = ['response' => 'negative', 'alert' => 'Masukan nomor telepon yang valid.'];
            } else {
                $value = "kd_supplier='$kd_supplier',nama_supplier='$nama_supplier',no_telp='$nohp_supplier',alamat='$alamat'";
                $response = $dis->update($table, $value, "kd_supplier", $_GET['id'], "?page=data-supplier");
            }
        }
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
                                <li class="list-inline-item">Kelola Data Supplier</li>
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
                            <strong class="card-title mb-3">Input Data Supplier</strong>
                        </div>
                        <div class="card-body">
                            <form method="post">
                                <div class="form-group">
                                    <label for="">Kode Supplier</label>
                                    <input type="text" class="form-control form-control-sm" name="kode_supplier" style="font-weight: bold; color: red;" value="<?php echo $autokode; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Nama Supplier</label>
                                    <input type="text" class="form-control form-control-sm" name="nama_supplier" value="<?php echo @$editData['nama_supplier'] ?>" placeholder="Masukkan Nama Supplier">
                                </div>
                                <div class="form-group">
                                    <label for="">No Telp Supplier</label>
                                    <input type="text" class="form-control form-control-sm" name="nohp_supplier" value="<?php echo @$editData['no_telp']; ?>" placeholder="Masukkan Nomor Telepon">
                                </div>
                                <div class="form-group">
                                    <label for="">Alamat</label>
                                    <textarea name="alamat" rows="5" class="form-control"><?php echo @$editData['alamat'] ?></textarea>
                                </div>
                                <?php if (isset($_GET['edit'])) : ?>
                                    <button type="submit" name="getUpdate" class="btn btn-primary"><i class="fa fa-check"></i> Konfirmasi</button>
                                    <a href="?page=data-supplier" class="btn btn-danger"> <i class="fa fa-repeat"></i> Batal</a>
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
                            <strong class="card-title mb-3">Data Supplier</strong>
                        </div>
                        <div class="card-body">
                            <table id="myDataTables" class="table table-responsive table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <td>Kode Supplier</td>
                                        <td>Nama Supplier</td>
                                        <td>No Telp</td>
                                        <td>Alamat</td>
                                        <td>Aksi</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($dataDis as $ds) {
                                    ?>
                                        <tr>
                                            <td><?= $ds['kd_supplier'] ?></td>
                                            <td><?= $ds['nama_supplier'] ?></td>
                                            <td><?= $ds['no_telp'] ?></td>
                                            <td><?= $ds['alamat'] ?></td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a data-toggle="tooltip" data-placement="top" title="Edit" href="?page=data-supplier&edit&id=<?= $ds['kd_supplier'] ?>" class="btn btn-info"><i class="fa fa-edit"></i></a>
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
                                                    text: "Hapus Data Supplier?",
                                                    type: "error",
                                                    showCancelButton: true,
                                                    confirmButtonText: "Konfirmasi",
                                                    cancelButtonText: "Batal",
                                                    closeOnConfirm: false,
                                                    closeOnCancel: true
                                                }, function(isConfirm) {
                                                    if (isConfirm) {
                                                        window.location.href = "?page=data-supplier&delete&id=<?php echo $ds['kd_supplier'] ?>";
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