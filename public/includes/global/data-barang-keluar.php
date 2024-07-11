<?php

$trs = new lsp();
$dataTransaksi = $trs->select("transaksi_terbaru order by kd_transaksi desc");
if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $dataDetail = $trs->edit("detailtransaksi", "kd_transaksi", $id);
      $total  = $trs->selectSumWhere("transaksi", "sub_total", "kd_transaksi='$id'");
      $jumlah_barang = $trs->selectSumWhere("transaksi", "jumlah", "kd_transaksi='$id'");
}

?>

<style>
      .col-sm-12 {
            background: white;
            padding: 20px;
            padding-bottom: 175px;
            border-radius: 5px;
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

<section class="au-breadcrumb m-t-75 print-sid">
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
                                                <li class="list-inline-item">Laporan Barang Keluar</li>
                                          </ul>
                                    </div>
                              </div>
                        </div>
                  </div>
            </div>
      </div>
</section>

<section class="statistic" style="padding-bottom: 100px;">
      <div class="section__content section__content--p30">
            <div class="container-fluid">
                  <div class="row">
                        <div class="col-sm-6 print-sid">
                              <div class="card">
                                    <div class="card-header">
                                          <h4>Cari Data Barang Keluar</h4>
                                    </div>
                                    <div class="card-body">
                                          <form method="post">
                                                <div class="form-group">
                                                      <a class="btn btn-primary btn-block" href="#myModal" data-toggle="modal">Pilih Barang</a>
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
                              <div class="row">
                                    <div class="col-6">
                                          <h3>PT Semen Indonesia Distributor</h3>
                                          <p>Jl. Raya Tegal - Pemalang KM 1 Kedondong Padaharja, Kec. Kramat Kab. Tegal Jawa Tengah</p>
                                          <h4>Laporan Barang Keluar</h4>
                                          <a href="#" class="btn btn-primary mt-3" onclick="window.print();">Cetak</a>
                                    </div>
                                    <div class="col-6 text-right">
                                          <img src="assets/img/icon/logo.png" alt="logo" class="w-75 text-right">
                                    </div>
                              </div>
                              <hr>
                              <div class="row">
                                    <div class="col-sm-6">Kode Barang Keluar : <?php echo $id ?></div>
                              </div>
                              <br>
                              <table class="table table-striped table-bordered" width="80%">
                                    <tr>
                                          <td>Kode Antrian</td>
                                          <td>Nama Barang</td>
                                          <td>Harga Satuan</td>
                                          <td>Jumlah</td>
                                          <td>Sub Total</td>
                                          <td>Tanggal Beli</td>
                                    </tr>
                                    <?php foreach ($dataDetail as $dd) : ?>
                                          <tr>
                                                <td><?= $dd['kd_pretransaksi'] ?></td>
                                                <td><?= $dd['nama_barang'] ?></td>
                                                <td><?= $dd['harga_barang'] ?></td>
                                                <td><?= $dd['jumlah'] ?></td>
                                                <td><?= "Rp." . number_format($dd['sub_total']) . ",-" ?></td>
                                                <td><?= date_ind($dd['tanggal_beli']); ?></td>
                                          </tr>
                                    <?php endforeach; ?>
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
                                          <td></td>
                                    </tr>
                              </table>
                              <br>
                              <div class="float-right text-center mt-3">
                                    <p>Tegal, <?= date_ind(date("Y-m-d")); ?></p>
                                    <div class="mt-3">
                                          <p class="mb-5">Penanggung Jawab</p>
                                          <p>( <?= $auth['nama_user'] ?> )</p>
                                    </div>
                                    <br>
                              <?php endif; ?>
                              <?php if (!isset($_GET['id'])) : ?>
                                    <div class="row">
                                          <div class="col-6">
                                                <h3>PT Semen Indonesia Distributor</h3>
                                                <p>Jl. Raya Tegal - Pemalang KM 1 Kedondong Padaharja, Kec. Kramat Kab. Tegal Jawa Tengah</p>
                                                <h4>Laporan Barang Keluar</h4>
                                                <a href="#" class="btn btn-primary mt-3" onclick="window.print();">Cetak</a>
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
                                                      <?php if ($dts['status'] == "Approved") : ?>
                                                            <tr>
                                                                  <td><?= $dts['kd_transaksi'] ?></td>
                                                                  <td><?= $dts['nama_user'] ?></td>
                                                                  <td><?= $dts['jumlah_beli'] ?></td>
                                                                  <td><?= "Rp." . number_format($dts['total_harga']) . ",-" ?></td>
                                                                  <td><?= date_ind($dts['tanggal_beli']) ?></td>
                                                            </tr>
                                                      <?php endif; ?>
                                                <?php endforeach; ?>
                                                <?php
                                                $grand = $trs->selectSumWhere("transaksi_terbaru", "total_harga", "status='Approved'");
                                                ?>
                                                <tr>
                                                      <td colspan="2"></td>
                                                      <td>Jumlah Total</td>
                                                      <td><?php echo "Rp." . number_format($grand['sum']) . ",-" ?></td>
                                                      <td></td>
                                                </tr>
                                          </tbody>
                                    </table>
                                    <div class="float-right text-center mt-3">
                                          <p>Tegal, <?= date_ind(date("Y-m-d")); ?></p>
                                          <div class="mt-3">
                                                <p class="mb-5">Penanggung Jawab</p>
                                                <p>( <?= $auth['nama_user'] ?> )</p>
                                          </div>
                                          <br>
                                    <?php endif; ?>
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
                        <table id="myDataTables" class="table table-responsive table-striped table-bordered" style="width:100%">
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
                                    <?php foreach ($dataTransaksi as $dts) : ?>
                                          <?php if ($dts['status'] == "Approved") : ?>
                                                <tr>
                                                      <td><a href="?page=data-barang-keluar&id=<?= $dts['kd_transaksi']; ?>"><?= $dts['kd_transaksi'] ?></a></td>
                                                      <td><?= $dts['nama_user'] ?></td>
                                                      <td><?= $dts['jumlah_beli'] ?></td>
                                                      <td><?= $dts['total_harga'] ?></td>
                                                      <td><?= date_ind($dts['tanggal_beli']) ?></td>
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
                                          <?php endif; ?>
                                    <?php endforeach ?>
                              </tbody>
                        </table>
                  </div>
            </div>
      </div>
</div>