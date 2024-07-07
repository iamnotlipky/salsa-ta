<?php

$br = new lsp();
if ($_SESSION['level'] != "Checker" && $_SESSION['level'] != "Admin") {
    header("location:index.php");
}

$table = "table_barang_rijek";
$getLayout = $br->select("table_layout");
$getSatuan = $br->select("table_satuan");
$getSupplier = $br->select("table_supplier");
$autokode = $br->autokode("table_barang_rijek", "kd_barang", "BR");
$waktu    = date("Y-m-d");

if (isset($_POST['add-barang-rijek'])) {
    $kode_barang    = $br->validateHtml($_POST['kode_barang']);
    $nama_barang    = $br->validateHtml($_POST['nama_barang']);
    $layout         = $br->validateHtml($_POST['layout']);
    $supplier       = $br->validateHtml($_POST['supplier']);
    $satuan         = $_POST['satuan'];
    $harga          = $br->validateHtml($_POST['harga']);
    $stok           = $br->validateHtml($_POST['stok']);
    $foto           = $_FILES['foto'];
    $ket            = $_POST['ket'];
    $status            = $_POST['status'];

    if ($kode_barang == " " || $nama_barang == " " || $layout == " " || $supplier == " " || $satuan == " " || $harga == " " || $stok == " " || $foto == " " || $ket == " " || $status == " ") {
        $response = ['response' => 'negative', 'alert' => 'Lengkapi Formulir Input Data Barang!'];
    } else {
        if ($harga < 0 || $stok < 0 || $harga == 0 || $stok == 0) {
            $response = ['response' => 'negative', 'alert' => 'Harga atau Stok Barang Tidak Boleh Nol atau Kurang Dari Nol!'];
        } else {
            $response = $br->validateImage();
            if ($response['types'] == "true") {
                $value = "'$kode_barang','$nama_barang','$layout','$supplier','$satuan','$waktu','$harga','$stok','$response[image]','$ket','$status'";
                $response = $br->insert($table, $value, "?page=data-barang-rijek");
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
                                <li class="list-inline-item active"><?= $auth['level']; ?></li>
                                <li class="list-inline-item seprate">
                                    <span>/</span>
                                </li>
                                <li class="list-inline-item">Input Barang Rijek</li>
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
                    <form method="post" enctype="multipart/form-data">
                        <div class="card">
                            <div class="au-card-title">
                                <div class="bg-overlay bg-primary"></div>
                                <h3>
                                    <i class="zmdi zmdi-account-calendar"></i>Input Barang Rijek
                                </h3>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="">Kode Barang</label>
                                            <input type="text" style="font-weight: bold; color: red;" class="form-control" name="kode_barang" value="<?php echo $autokode; ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Nama Barang</label>
                                            <input type="text" placeholder="Nama Barang" class="form-control" name="nama_barang" value="<?php echo @$_POST['nama_barang'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Layout Barang</label>
                                            <select name="layout" class="form-control">
                                                <option value=" ">Pilih Layout</option>
                                                <?php foreach ($getLayout as $mr) { ?>
                                                    <option value="<?= $mr['kd_layout'] ?>"><?= $mr['layout'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Nama Supplier</label>
                                            <select name="supplier" class="form-control">
                                                <option value=" ">Pilih Supplier</option>
                                                <?php foreach ($getSupplier as $sp) { ?>
                                                    <option value="<?= $sp['kd_supplier'] ?>"><?= $sp['nama_supplier'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Satuan</label>
                                            <select name="satuan" class="form-control">
                                                <option value=" ">Pilih Satuan</option>
                                                <?php foreach ($getSatuan as $st) { ?>
                                                    <option value="<?= $st['kd_satuan'] ?>"><?= $st['satuan'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="">Harga Barang</label>
                                            <input type="number" class="form-control" name="harga">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Stok Barang</label>
                                            <input type="number" class="form-control" name="stok">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Gambar</label>
                                            <input type="file" class="form-control-file" name="foto">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Keterangan</label>
                                            <input type="text" class="form-control" name="ket">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="status" value="Unapproved" hidden readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button name="add-barang-rijek" class="btn btn-primary"><i class="fa fa-download"></i> Simpan</button>
                                <button type="reset" class="btn btn-danger"><i class="fa fa-eraser"></i> Hapus</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>