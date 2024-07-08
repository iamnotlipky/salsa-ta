<?php

$qb = new lsp();
$dataB = $qb->select("detailbarang order by kd_barang desc");
$totbal = $qb->selectSumWhere("detailbarang", "stok_barang", "status='Approved'");
$total  = $qb->selectCountWhere("detailbarang", "kd_barang", "status='Approved'");

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
                <li class="list-inline-item">Laporan Barang Masuk</li>
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
        <div class="col-sm-12 rounded mb-5">
          <div class="row">
            <div class="col-6">
              <h3>PT Semen Indonesia Distributor</h3>
              <p>Jl. Raya Tegal - Pemalang KM 1 Kedondong Padaharja, Kec. Kramat Kab. Tegal Jawa Tengah</p>
              <h4>Laporan Barang Masuk</h4>
            </div>
            <div class="col-6 text-right">
              <img src="assets/img/icon/logo.png" alt="logo" class="w-75 text-right">
            </div>
          </div>
          <div class="my-3">
            <button class="btn btn-primary" onclick="window.print()">Cetak</button>
          </div>
          <div class="table-responsive">
            <table class="table table-striped table-bordered" border="1" cellspacing="0" width="100%;" cellpadding="20">
              <thead>
                <tr>
                  <td>Kode barang</td>
                  <td>Nama barang</td>
                  <td>Lokasi</td>
                  <td>Supplier</td>
                  <td>Tanggal Masuk</td>
                  <td>Harga</td>
                  <td>Stok</td>
                  <td>Satuan</td>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($dataB)) : ?>
                  <?php foreach ($dataB as $ds) : ?>
                    <?php if ($ds['status'] == "Approved") : ?>
                      <tr>
                        <td><?= $ds['kd_barang'] ?></td>
                        <td><?= $ds['nama_barang'] ?></td>
                        <td><?= $ds['layout'] ?></td>
                        <td><?= $ds['nama_supplier'] ?></td>
                        <td><?= date_ind($ds['tanggal_masuk']) ?></td>
                        <td><?= number_format($ds['harga_barang']) ?></td>
                        <td><?= $ds['stok_barang'] ?></td>
                        <td><?= $ds['satuan'] ?></td>
                      </tr>
                    <?php endif; ?>
                  <?php endforeach; ?>
              </tbody>
              <tr>
                <td colspan="7">Total barang yang di miliki</td>
                <td><?php echo $totbal['sum']; ?></td>
              </tr>
              <tr>
                <td colspan="7">Jumlah Model Barang</td>
                <td><?php echo $total['count']; ?></td>
              </tr>
            <?php else : ?>
              <tr class="text-center">
                <td colspan="8">Tidak Ada Data</td>
              </tr>
            <?php endif; ?>
            </table>
            <div class="float-right text-center mt-3">
              <p>Tegal, <?= date_ind(date("Y-m-d")); ?></p>
              <div class="mt-2">
                <p class="pb-5">Penanggung Jawab</p>
                <p class="pt-3">( <?= $auth['nama_user'] ?> )</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>