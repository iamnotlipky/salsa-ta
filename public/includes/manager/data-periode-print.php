<!DOCTYPE html>
<html lang="en">

<head>
    <title>Warehouse PT SID Cabang Tegal</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../assets/css/mains.css">

    <!-- Website Icon -->
    <link href="../../assets/img/icon/icon.png" rel="icon">
    <link href="../../assets/img/icon/icon.png" rel="apple-touch-icon">
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
    require_once "../../../functions/sessions.php";
    require_once "../../../functions/date.php";

    $qb = new lsp();
    if (!isset($_GET['dateAwal']) || !isset($_GET['dateAkhir'])) {
        header("location:manager-panel.php?page=data-barang-periode");
    }
    $whereparam = "tanggal_masuk";
    $param      = $_GET['dateAwal'];
    $param1     = $_GET['dateAkhir'];
    $dataB      = $qb->selectBetween("detailbarang", $whereparam, $param, $param1);
    $dataC      = $qb->selectBetween("detailbarangrijek", $whereparam, $param, $param1);
    ?>

    <div class="row">
        <div class="col-12" style="padding: 50px;">
            <div class="row">
                <div class="col-6">
                    <h3>PT Semen Indonesia Distributor</h3>
                    <p>Jl. Raya Tegal - Pemalang KM 1 Kedondong Padaharja, Kec. Kramat Kab. Tegal Jawa Tengah</p>
                    <h4>Laporan Barang Periode</h4>
                    <p>Dari tanggal : <?= date_ind($_GET['dateAwal']); ?> sampai <?= date_ind($_GET['dateAkhir']); ?></p>
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
                            foreach (@$dataB['data'] as $ds) {
                                if ($ds['status'] == "Approved") { ?>
                                    <tr>
                                        <td><?= $ds['kd_barang'] ?></td>
                                        <td><?= $ds['nama_barang'] ?></td>
                                        <td><?= $ds['layout'] ?></td>
                                        <td><?= $ds['nama_supplier'] ?></td>
                                        <td><?= date_ind($ds['tanggal_masuk']) ?></td>
                                        <td><?= number_format($ds['harga_barang']) ?></td>
                                        <td><?= $ds['stok_barang'] ?></td>
                                    </tr>
                            <?php $no++;
                                }
                            } ?>
                            <tr>
                                <td colspan="5"></td>
                                <td>Jumlah Barang Masuk</td>
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
                        <?php
                        if (count(@$dataC) > 0) {
                            $no = 1;
                            foreach (@$dataC['data'] as $dsr) {
                                if ($dsr['status'] == "Approved") { ?>
                                    <tr>
                                        <td><?= $dsr['kd_barang'] ?></td>
                                        <td><?= $dsr['nama_barang'] ?></td>
                                        <td><?= $dsr['layout'] ?></td>
                                        <td><?= $dsr['nama_supplier'] ?></td>
                                        <td><?= date_ind($dsr['tanggal_masuk']) ?></td>
                                        <td><?= number_format($dsr['harga_barang']) ?></td>
                                        <td><?= $dsr['stok_barang'] ?></td>
                                    </tr>
                            <?php $no++;
                                }
                            } ?>
                            <tr>
                                <td colspan="5"></td>
                                <td>Jumlah Barang Rijek</td>
                                <td>
                                    <?php foreach ($dataC['jumlah'] as $datasr) : ?>
                                        <?php echo $datasr; ?>
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
                <p>Tegal, <?= date_ind(date("Y-m-d")); ?></p>
                <div class="mt-2">
                    <p class="pb-5">Penanggung Jawab</p>
                    <p class="pt-3">( <?= $auth['nama_user'] ?> )</p>
                </div>
            </div>
        </div>
    </div>

</body>

</html>