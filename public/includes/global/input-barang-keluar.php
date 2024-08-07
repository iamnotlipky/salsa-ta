<?php

$trans     = new lsp();
$transkode = $trans->autokode("table_transaksi", "kd_transaksi", "TR");
$antrian   = $trans->autokode("table_pretransaksi", "kd_pretransaksi", "AN");
$barangs   = $trans->select("table_barang");

if (isset($_GET['get-barang'])) {
    $id = $_GET['id'];
    $dataR = $trans->selectWhere("table_barang", "kd_barang", $id);
}

$sum       = $trans->selectSum("table_pretransaksi", "sub_total");
$sql2      = "SELECT COUNT(kd_pretransaksi) as count FROM table_pretransaksi WHERE kd_transaksi = '$transkode'";
$exec2     = mysqli_query($con, $sql2);
$assoc2    = mysqli_fetch_assoc($exec2);

if (isset($_POST['simpan-barang'])) {
    if (!isset($_SESSION['transaksi'])) {
        $_SESSION['transaksi'] = true;
    }
    $kd_transaksi    = $_POST['kd_transaksi'];
    $kd_pretransaksi = $_POST['kd_pretransaksi'];
    $barang          = $_POST['kd_barang'];
    $jumlah          = $_POST['jumlah'];
    $total           = $_POST['total'];

    if ($kd_transaksi == "" || $kd_pretransaksi == "" || $barang == "" || $jumlah == "" || $total == "") {
        $response = ['response' => 'negative', 'alert' => 'Lengkapi Formulir!'];
    } else {
        if ($jumlah < 1) {
            $response = ['response' => 'negative', 'alert' => 'Pembelian Minimal Satu Barang!'];
        } else {
            $sisa = $trans->selectWhere("table_barang", "kd_barang", $barang);
            if ($sisa['stok_barang'] < $jumlah) {
                $response = ['response' => 'negative', 'alert' => 'Stok Tersisa ' . $sisa['stok_barang']];
            } else {
                $sql = "SELECT * FROM table_pretransaksi WHERE kd_transaksi = '$kd_transaksi' AND kd_barang = '$barang'";
                $exe = mysqli_query($con, $sql);
                $num = mysqli_num_rows($exe);
                $dta = mysqli_fetch_assoc($exe);
                if ($num > 0) {
                    $jumlah = $dta['jumlah'] + $jumlah;
                    $value = "jumlah='$jumlah'";
                    $insert = $trans->update("table_pretransaksi", $value, "kd_transaksi = '$kd_transaksi' AND kd_barang", $barang, "?page=input-barang-keluar");
                } else {
                    $value = "'$kd_pretransaksi','$kd_transaksi','$barang','$jumlah','$total'";
                    $insert = $trans->insert("table_pretransaksi", $value, "?page=input-barang-keluar");
                }
            }
        }
    }
}

if (isset($_GET['delete'])) {
    $id       = $_GET['id'];
    $where    = "kd_pretransaksi";
    $response = $trans->delete("table_pretransaksi", $where, $id, "?page=input-barang-keluar");
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
                                <li class="list-inline-item">Input Barang Keluar</li>
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
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3>Input Barang Keluar</h3>
                        </div>
                        <div class="card-body">
                            <form method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">Kode Transaksi</label>
                                        <input style="font-weight: bold; color: red;" type="text" class="form-control" value="<?= $transkode; ?>" readonly name="kd_transaksi">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Kode Antrian</label>
                                        <input style="font-weight: bold; color: red;" type="text" class="form-control" value="<?= $antrian; ?>" readonly name="kd_pretransaksi" id="antrian">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="kd_barang" readonly placeholder="Kode Barang" value="<?php echo @$dataR['kd_barang'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <a class="btn btn-primary btn-block" href="#barangmodal" data-toggle="modal">Pilih Barang</a>
                                                </div>
                                            </div>
                                            <div class="col-sm-4"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Nama Barang</label>
                                            <input type="text" class="form-control" name="nama_barang" value="<?php echo @$dataR['nama_barang']; ?>" readonly />
                                        </div>
                                        <div class="form-group">
                                            <label for="">Harga Barang</label>
                                            <input type="text" class="form-control" max="100" name="harba" value="<?php echo @$dataR['harga_barang']; ?>" id="harba" readonly="">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Quantity</label>
                                            <input type="number" class="form-control" name="jumlah" value="" id="jumjum" min="0" required>
                                        </div>
                                        <div class=" form-group">
                                            <label for="">Total</label>
                                            <input type="text" class="form-control" max="100" name="total" readonly id="totals">
                                        </div>
                                        <button class="btn btn-primary" name="simpan-barang"><i class="fa fa-arrow-right"></i> Tambah Ke Antrian</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3>Antrian Barang Keluar</h3>
                        </div>
                        <div class="card-body">
                            <?php if ($assoc2['count'] > 0 || isset($_POST['simpan-barang'])) : ?>
                                <a class="btn btn-success" id="pembayaran" href="?page=cetak-surat-jalan"> Cetak Surat Jalan <i class="fa fa-arrow-right"></i></a>
                                <br>
                                <br>
                            <?php endif; ?>
                            <?php
                            $kr        = new lsp();
                            $transkode = $kr->autokode("table_transaksi", "kd_transaksi", "TR");
                            $datas     = $kr->querySelect("SELECT * FROM transaksi WHERE kd_transaksi = '$transkode'");
                            $sql       = "SELECT SUM(sub_total) as sub FROM table_pretransaksi WHERE kd_transaksi = '$transkode'";
                            $exec      = mysqli_query($con, $sql);
                            $assoc     = mysqli_fetch_assoc($exec);
                            ?>
                            <table class="table table-striped table-bordered table-responsive">
                                <tr>
                                    <td>Kode Antrian</td>
                                    <td>Nama Barang</td>
                                    <td>Quantity</td>
                                    <td>Sub Total</td>
                                    <td>Opsi</td>
                                </tr>
                                <?php
                                if (count($datas) > 0) {
                                    $no = 1;
                                    foreach ($datas as $dd) { ?>
                                        <tr>
                                            <td><?= $dd['kd_pretransaksi']; ?></td>
                                            <td><?= $dd['nama_barang']; ?></td>
                                            <td><?= $dd['jumlah']; ?></td>
                                            <td><?= $dd['sub_total']; ?></td>
                                            <td class="text-center">
                                                <a href="#" id="btdelete<?php echo $no; ?>" class="btn btn-danger">Batal</a>
                                            </td>
                                        </tr>
                                        <script src="assets/vendor/jquery-3.2.1.min.js"></script>
                                        <script>
                                            $("#btdelete<?php echo $no; ?>").click(function() {
                                                swal({
                                                    title: "Batal",
                                                    text: "Batalkan Antrian Barang?",
                                                    type: "warning",
                                                    showCancelButton: true,
                                                    confirmButtonText: "Konfirmasi",
                                                    cancelButtonText: "Kembali",
                                                    closeOnConfirm: false,
                                                    closeOnCancel: true
                                                }, function(isConfirm) {
                                                    if (isConfirm) {
                                                        window.location.href = "?page=input-barang-keluar&delete&id=<?= $dd['kd_pretransaksi']; ?>";
                                                    }
                                                })
                                            })
                                        </script>
                                    <?php $no++;
                                    } ?>
                                    <?php if (!$assoc['sub'] == "") : ?>
                                        <tr>
                                            <td colspan="4">Total Harga</td>
                                            <td><?php echo $assoc['sub'] ?></td>
                                        </tr>
                                    <?php endif ?>
                                <?php } else { ?>
                                    <td colspan="5" class="text-center">Tidak Ada Antrian</td>
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="barangmodal" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Pilih Barang</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="myDataTables" class="table table-responsive table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <td>Kode Barang</td>
                            <td>Nama Barang</td>
                            <td>Harga</td>
                            <td>Stok</td>
                            <td>Status</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($barangs as $brs) {
                            if ($brs['status'] == "Approved") { ?>
                                <tr>
                                    <td><a href="admin-panel.php?page=input-barang-keluar&get-barang&id=<?php echo $brs['kd_barang'] ?>"><?php echo $brs['kd_barang'] ?></a></td>
                                    <td><?php echo $brs['nama_barang'] ?></td>
                                    <td><?php echo $brs['harga_barang'] ?></td>
                                    <td><?php echo $brs['stok_barang'] ?></td>
                                    <td><span class="badge badge-success"><?= $brs['status'] ?></span></td>
                                </tr>
                        <?php }
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="assets/vendor/jquery-3.2.1.min.js"></script>
<script>
    $(document).ready(function() {
        $('#barang_nama').change(function() {
            var barang = $(this).val();
            $.ajax({
                type: "POST",
                url: 'ajaxTransaksi.php',
                data: {
                    'selectData': barang
                },
                success: function(data) {
                    $("#harba").val(data);
                    $("#jumjum").val();
                    var jum = $("#jumjum").val();
                    var kali = data * jum;
                    $("#totals").val(kali);
                }
            })
        });


        $('#jumjum').keyup(function() {
            var jumlah = $(this).val();
            var harba = $('#harba').val();
            var kali = harba * jumlah;
            $("#totals").val(kali);
        });

        $('#bayar').keyup(function() {
            var bayar = $(this).val();
            var total = $('#tot').val();
            var kembalian = bayar - total;
            $('#kem').val(kembalian);
        })
    })
</script>