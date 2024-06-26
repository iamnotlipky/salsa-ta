<?php

$trs = new lsp();
$dataTransaksi = $trs->select("transaksi_terbaru");
if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $dataDetail = $trs->edit("detailTransaksi", "kd_transaksi", $id);
      $total  = $trs->selectSumWhere("transaksi", "sub_total", "kd_transaksi='$id'");
      $jumlah_barang = $trs->selectSumWhere("transaksi", "jumlah", "kd_transaksi='$id'");
}

?>

<style>
      .col-sm-12 {
            background: white;
            padding: 20px;
      }

      @media print {
            table {
                  align-content: center;
            }

            .print {
                  margin-top: 175px;
            }

            .btn {
                  display: none !important;
            }

            .ds {
                  display: none;
            }

            .cari {
                  display: none !important;
                  box-shadow: none !important;
            }

            hr {
                  display: none;
            }

            .hd {
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
                                                <li class="list-inline-item active"><?= $auth['level']; ?></li>
                                                <li class="list-inline-item seprate">
                                                      <span>/</span>
                                                </li>
                                                <li class="list-inline-item">Kelola Barang Keluar</li>
                                          </ul>
                                    </div>
                              </div>
                        </div>
                  </div>
            </div>
      </div>
</section>

<section class="statistic pb-5">
      <div class="section__content section__content--p30">
            <div class="container-fluid">
                  <div class="row">
                        <div class="col-sm-6">
                              <div class="card">
                                    <div class="card-header">
                                          <h4>Cari Data Barang Keluar</h4>
                                    </div>
                                    <div class="card-body">
                                          <form method="post">
                                                <div class="form-group">
                                                      <a class="btn btn-dark btn-block" href="#myModal" data-toggle="modal">Pilih Barang</a>
                                                </div>
                                                <?php if (isset($_GET['id'])) : ?>
                                                      <a href="?page=data-barang-keluar" class="btn btn-danger btn-block"><i class="fa fa-repeat"></i> Muat Ulang</a>
                                                <?php endif ?>
                                          </form>
                                    </div>
                              </div>
                        </div>
                  </div>
                  <div class="col-sm-12">
                        <?php if (isset($_GET['id'])) : ?>
                              <div class="row print">
                                    <div class="col-6">
                                          <h4>Data Barang Keluar</h4>
                                          <p>PT Semen Indonesia Distributor</p>
                                    </div>
                                    <div class="col-6 text-right">
                                          <img src="assets/img/icon/logo.png" alt="logo" class="w-75 text-right">
                                    </div>
                              </div>
                              <hr>
                              <div class="row">
                                    <div class="col-sm-6">Kode Barang Keluar : <?php echo $id ?></div>
                                    <div class="col-sm-6">
                                          <p class="text-right"><span><?php echo "Tanggal Cetak : " . date("Y-m-d"); ?></p>
                                    </div>
                              </div>
                              <br>
                              <table class="table table-striped table-bordered" width="80%">
                                    <tr>
                                          <td>Kode Antrian</td>
                                          <td>Nama Barang</td>
                                          <td>Harga Satuan</td>
                                          <td>Jumlah</td>
                                          <td>Sub Total</td>
                                    </tr>
                                    <?php foreach ($dataDetail as $dd) : ?>
                                          <tr>
                                                <td><?= $dd['kd_pretransaksi'] ?></td>
                                                <td><?= $dd['nama_barang'] ?></td>
                                                <td><?= $dd['harga_barang'] ?></td>
                                                <td><?= $dd['jumlah'] ?></td>
                                                <td><?= "Rp." . number_format($dd['sub_total']) . ",-" ?></td>
                                          </tr>
                                    <?php endforeach ?>
                                    <tr>
                                          <td colspan="2"></td>
                                          <td>Jumlah Pembelian Barang</td>
                                          <td><?php echo $jumlah_barang['sum'] ?></td>
                                          <td></td>
                                    </tr>
                                    <tr>
                                          <td colspan="2"></td>
                                          <td colspan="2">Total</td>
                                          <td><?php echo "Rp." . number_format($total['sum']) . ",-" ?></td>
                                    </tr>
                              </table>
                              <br>
                              <p>Tanggal Beli : <?php echo $dd['tanggal_beli']; ?></p>
                              <br>
                              <a href="#" class="btn btn-dark" onclick="window.print();">Cetak</a>
                        <?php endif ?>
                        <?php if (!isset($_GET['id'])) : ?>
                              <div class="row print">
                                    <div class="col-6">
                                          <h4>Data Barang Keluar</h4>
                                          <span>PT Semen Indonesia Distributor</span>
                                          <p class="pt-3"><?php echo "Tanggal Cetak : " . date("Y-m-d"); ?></p>
                                    </div>
                                    <div class="col-6 text-right">
                                          <img src="assets/img/icon/logo.png" alt="logo" class="w-75 text-right">
                                    </div>
                              </div>
                              <br>
                              <table class="table table-hover table-bordered" width="100%;" align="center">
                                    <thead>
                                          <tr>
                                                <td>Kode Transaksi</td>
                                                <td>Nama Penginput</td>
                                                <td>Jumlah Beli</td>
                                                <td>Total Harga</td>
                                                <td>Tanggal Beli</td>
                                          </tr>
                                    </thead>
                                    <tbody>
                                          <?php foreach ($dataTransaksi as $dts) : ?>
                                                <tr>
                                                      <td><?= $dts['kd_transaksi'] ?></td>
                                                      <td><?= $dts['nama_user'] ?></td>
                                                      <td><?= $dts['jumlah_beli'] ?></td>
                                                      <td><?= "Rp." . number_format($dts['total_harga']) . ",-" ?></td>
                                                      <td><?= $dts['tanggal_beli'] ?></td>
                                                </tr>
                                          <?php endforeach ?>
                                          <?php
                                          $grand = $trs->selectSum("transaksi", "sub_total");
                                          ?>
                                          <tr>
                                                <td colspan="2"></td>
                                                <td>Jumlah Total</td>
                                                <td><?php echo "Rp." . number_format($grand['sum']) . ",-" ?></td>
                                                <td></td>
                                          </tr>
                                    </tbody>
                              </table>
                              <br>
                              <a href="#" class="btn btn-dark" onclick="window.print();">Cetak</a>
                        <?php endif ?>
                  </div>
            </div>
      </div>
</section>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                  <div class="modal-header">
                        <h3>Pilih Data Barang Keluar</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                        </button>
                  </div>
                  <div class="modal-body">
                        <div class="table-responsive">
                              <table id="myDataTables" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                          <tr>
                                                <td>Kode Transaksi</td>
                                                <td>Nama Penginput</td>
                                                <td>Jumlah Beli</td>
                                                <td>Total Harga</td>
                                                <td>Tanggal Beli</td>
                                                <td>Status</td>
                                                <td>Opsi</td>
                                          </tr>
                                    </thead>
                                    <tbody>
                                          <?php if (!empty($dataTransaksi)) : ?>
                                                <?php foreach ($dataTransaksi as $dts) : ?>
                                                      <tr>
                                                            <td><a href="?page=data-barang-keluar&id=<?= $dts['kd_transaksi']; ?>"><?= $dts['kd_transaksi'] ?></a></td>
                                                            <td><?= $dts['nama_user'] ?></td>
                                                            <td><?= $dts['jumlah_beli'] ?></td>
                                                            <td><?= $dts['total_harga'] ?></td>
                                                            <td><?= $dts['tanggal_beli'] ?></td>
                                                            <td><?php if ($dts['status'] == "Unapproved") : ?>
                                                                        <span class="badge badge-danger">Unapproved</span>
                                                                  <?php elseif ($dts['status'] == "Approved") : ?>
                                                                        <span class="badge badge-success">Approved</span>
                                                                  <?php endif; ?>
                                                            </td>
                                                            <td class="text-center">
                                                                  <a href="?page=surat-jalan&id=<?= $dts['kd_transaksi'] ?>" data-toggle="tooltip" data-placement="top" title="Detail" class="btn btn-warning text-white"><i class="fa fa-search"></i></a>

                                                            </td>
                                                      </tr>
                                                <?php endforeach ?>
                                          <?php else : ?>
                                                <tr class="text-center">
                                                      <td colspan="5">Tidak Ada Data</td>
                                                </tr>
                                          <?php endif; ?>
                                    </tbody>
                              </table>
                        </div>
                  </div>
            </div>
      </div>
</div>