<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard Admin</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../assets/css/mains.css">
</head>

<style>
    @media print {
        .btn {
            display: none;
        }

        .hd {
            display: none;
        }
    }
</style>

<body>
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
            <button class="btn btn-primary mb-3" onclick="window.print()">Cetak</button>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Kode barang</th>
                            <th>Nama barang</th>
                            <th>Layout</th>
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
                                    <td><?= $ds['layout'] ?></td>
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
            </div>
            <div class="float-right text-center mt-3">
              <p>Tegal, <?php echo date("Y-m-d"); ?></p>
              <div class="mt-3">
                <p class="mb-5">Penanggung Jawab</p>
                <p>( <?= $auth['nama_user'] ?> )</p>
                </div>
            </div>
        </div>
    </div>

</body>

</html>