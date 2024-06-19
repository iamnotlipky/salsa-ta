<?php

$br = new lsp();
if ($_SESSION['level'] != "Admin" && $_SESSION['level'] != "Checker") {
    header("location:../index.php");
    exit();
}

$table = "table_barang";
$getMerek = $br->select("table_merek");
$getDistr = $br->select("table_supplier");
$autokode = $br->autokode("table_barang", "kd_barang", "BR");
$waktu    = date("Y-m-d");

if (isset($_POST['simpan-barang'])) {
    $kode_barang  = $br->validateHtml($_POST['kode_barang']);
    $nama_barang  = $br->validateHtml($_POST['nama_barang']);
    $merek_barang = $br->validateHtml($_POST['merek_barang']);
    $supplier  = $br->validateHtml($_POST['supplier']);
    $harga        = $br->validateHtml($_POST['harga']);
    $stok         = $br->validateHtml($_POST['stok']);
    $foto         = $_FILES['foto'];
    $ket   = $_POST['ket'];

    if ($kode_barang == " " || $nama_barang == " " || $merek_barang == " " || $supplier == " " || $harga == " " || $stok == " " || $foto == " " || $ket == " ") {
        $response = ['response' => 'negative', 'alert' => 'Lengkapi Formulir Input Data!'];
    } else {
        if ($harga < 0 || $stok < 0 || $harga == 0 || $stok == 0) {
            $response = ['response' => 'negative', 'alert' => 'Harga atau Stok Barang Tidak Boleh Nol atau Kurang Dari Nol!'];
        } else {
            $response = $br->validateImage();
            if ($response['types'] == "true") {
                $value = "'$kode_barang','$nama_barang','$merek_barang','$supplier','$waktu','$harga','$stok','$response[image]','$ket'";

                $response = $br->insert($table, $value, "?page=viewBarang");
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
                                <li class="list-inline-item">Dashboard</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="main-content" style="margin-top: 20px;">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form method="post" enctype="multipart/form-data">
                        <div class="card">
                            <div class="au-card-title">
                                <div class="bg-overlay bg-priamry"></div>
                                <h3>
                                    <i class="zmdi zmdi-account-calendar"></i>Input Barang Masuk
                                </h3>
                            </div>
                            <div class="mt-3 ml-3">
                                <a href="?page=viewBarang" class="btn btn-dark"><i class="fas fa-arrow-left"></i> Kembali</a>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="">Kode barang</label>
                                            <input type="text" style="font-weight: bold; color: red;" class="form-control" name="kode_barang" value="<?php echo $autokode; ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Nama barang</label>
                                            <input type="text" placeholder="Nama Barang" class="form-control" name="nama_barang" value="<?php echo @$_POST['nama_barang'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Nama Merek</label>
                                            <select name="merek_barang" class="form-control">
                                                <option value=" ">Pilih Merek</option>
                                                <?php foreach ($getMerek as $mr) { ?>
                                                    <option value="<?= $mr['kd_merek'] ?>"><?= $mr['merek'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Nama Supplier</label>
                                            <select name="supplier" class="form-control">
                                                <option value=" ">Pilih Supplier</option>
                                                <?php foreach ($getDistr as $dr) { ?>
                                                    <option value="<?= $dr['kd_supplier'] ?>"><?= $dr['nama_supplier'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="">Harga barang</label>
                                            <input type="number" class="form-control" name="harga">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Stok barang</label>
                                            <input type="number" class="form-control" name="stok">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Gambar</label>
                                            <input type="file" class="form-control" name="foto">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Keterangan</label>
                                            <input type="text" class="form-control" name="ket">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button name="button-simpan" class="btn btn-primary"><i class="fa fa-download"></i> Simpan</button>
                                <button type="reset" class="btn btn-danger"><i class="fa fa-eraser"></i> Hapus</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>