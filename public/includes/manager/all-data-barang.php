<?php
require_once "../config/config.php";
require_once "../functions/functions.php";
$qb = new lsp();
$dataB = $qb->select("detailbarang");
$totbal = $qb->selectSum("detailbarang", "stok_barang");
$total  = $qb->selectCount("detailbarang", "kd_barang");
?>

<style>
  .col-sm-12 {
    background-color: white;
    padding: 20px;
  }

  @media print {
    .btn {
      display: none;
    }

    .au-breadcrumb {
      display: none;
    }
  }
</style>

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
                <li class="list-inline-item">Laporan Semua Barang</li>
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
        <div class="col-sm-12 rounded">
          <div class="row">
            <div class="col-6">
              <h4>Laporan Semua Barang</h4>
              <p>PT Semen Indonesia Distributor</p>
            </div>
            <div class="col-6 text-right">
              <img src="assets/img/icon/logo.png" alt="logo" class="w-75 text-right">
            </div>
          </div>
          <div class="my-3">
            <button class="btn btn-primary" onclick="window.print()">Cetak</button>
          </div>
          <p class="text-right mb-3">Tanggal Cetak: <?php echo date("Y-m-d"); ?></p>
          <div class="table-responsive">
            <table class="table table-striped table-bordered" border="1" cellspacing="0" width="100%;" cellpadding="20">
              <thead>
                <tr>
                  <th>Kode barang</th>
                  <th>Nama barang</th>
                  <th>Lokasi</th>
                  <th>Satuan</th>
                  <th>Supplier</th>
                  <th>Tanggal Masuk</th>
                  <th>Harga</th>
                  <th>Stok</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($dataB as $ds) { ?>
                  <tr>
                    <td><?= $ds['kd_barang'] ?></td>
                    <td><?= $ds['nama_barang'] ?></td>
                    <td><?= $ds['lokasi'] ?></td>
                    <td><?= $ds['satuan'] ?></td>
                    <td><?= $ds['nama_supplier'] ?></td>
                    <td><?= $ds['tanggal_masuk'] ?></td>
                    <td><?= number_format($ds['harga_barang']) ?></td>
                    <td><?= $ds['stok_barang'] ?></td>
                  <?php $no++;
                } ?>
              </tbody>
              <tr>
                <td colspan="6">Total barang yang di miliki</td>
                <td><?php echo $totbal['sum']; ?></td>
              </tr>
              <tr>
                <td colspan="6">Jumlah Model Barang</td>
                <td><?php echo $total['count']; ?></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>