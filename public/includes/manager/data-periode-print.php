<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard Admin</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../assets/css/mains.css">
</head>
<style>
    body {
        overflow-x: hidden;
    }
</style>

<body onload="window.print();">
    <?php
    require_once "../../../config/config.php";
    require_once "../../../functions/functions.php";

    $qb = new lsp();
    if (!isset($_GET['dateAwal']) || !isset($_GET['dateAkhir'])) {
        header("location:manager-panel.php?page=data-barang-periode");
    }
    $whereparam = "tanggal_masuk";
    $param      = $_GET['dateAwal'];
    $param1     = $_GET['dateAkhir'];
    $dataB      = $qb->selectBetween("detailbarang", $whereparam, $param, $param1);
    ?>

    <div class="row">
        <div class="col-12" style="padding: 50px;">
            <div class="row">
                <div class="col-6">
                    <h4>Laporan Barang Periode</h4>
                    <p>PT Semen Indonesia Distributor</p>
                    <p>Dari tanggal : <?php echo $_GET['dateAwal']; ?> sampai <?php echo $_GET['dateAkhir'] ?></p>
                </div>
                <div class="col-6 text-right">
                    <img src="../../assets/img/icon/logo.png" alt="logo" class="w-50 text-right">
                </div>
            </div>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Kode barang</th>
                        <th>Nama barang</th>
                        <th>Lokasi</th>
                        <th>Supplier</th>
                        <th>Tanggal Masuk</th>
                        <th>Harga</th>
                        <th>Stok</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (count(@$dataB) > 0) {
                        $no = 1;
                        foreach (@$dataB['data'] as $ds) { ?>
                            <tr>
                                <td><?= $ds['kd_barang'] ?></td>
                                <td><?= $ds['nama_barang'] ?></td>
                                <td><?= $ds['lokasi'] ?></td>
                                <td><?= $ds['nama_supplier'] ?></td>
                                <td><?= $ds['tanggal_masuk'] ?></td>
                                <td><?= number_format($ds['harga_barang']) ?></td>
                                <td><?= $ds['stok_barang'] ?></td>
                            </tr>
                        <?php $no++;
                        } ?>
                        <tr>
                            <td colspan="5"></td>
                            <td>Jumlah</td>
                            <td>
                                <?php foreach ($dataB['jumlah'] as $datas) : ?>
                                    <?php echo $datas; ?>
                                <?php endforeach ?>
                        </tr>
                    <?php } else { ?>
                        <tr>
                            <td colspan="7" class="text-center">Tidak Ada Barang pada Periode Ini</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <p>Tanggal cetak : <?= date("Y-m-d"); ?></p>
        </div>
    </div>

</body>

</html>