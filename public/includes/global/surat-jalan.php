<?php

$nota  = new lsp();
$id = $_GET['id'];
$data   = $nota->edit("transaksi", "kd_transaksi", $id);
$total  = $nota->selectSumWhere("transaksi", "sub_total", "kd_transaksi='$id'");
$dataDetail = $nota->edit("detailTransaksi", "kd_transaksi", $id);
$jumlah_barang = $nota->selectSumWhere("transaksi", "jumlah", "kd_transaksi='$id'");

?>

<style>
	.col-sm-8 {
		background: white;
		padding: 20px;
	}

	@media print {
		table {
			align-content: center;
		}

		.ds {
			display: none;
		}

		.card {
			box-shadow: none;
			border: none;
		}

		.hd {
			display: none;
		}
	}
</style>

<!-- BREADCRUMB-->
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
								<li class="list-inline-item">Surat Jalan</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- END BREADCRUMB-->

<section class="statistic">
	<div class="section__content section__content--p30">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8">
					<div class="card">
						<div class="card-header">
							<div class="row">
								<div class="col-6">
									<h4>Nota</h4>
									<p>PT Semen Indonesia Distributor</p>
								</div>
								<div class="col-6">
									<img src="assets/img/icon/logo-sid.webp" alt="logo" class="w-75 float-right">
								</div>
							</div>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-sm-6">Nomor Surat Jalan : <?php echo $id ?></div>
								<div class="col-sm-6">
									<p class="text-right"><span><?php echo "Tanggal Cetak : " . date("Y-m-d"); ?></p>
								</div>
							</div>
							<br>
							<table class="table table-striped table-bordered" width="80%">
								<tr>
									<td>Kode Antrian</td>
									<td>Nama Barang</td>
									<!-- <td>Harga Satuan</td> -->
									<td>Jumlah</td>
									<td>Satuan</td>
									<!-- <td>Sub Total</td> -->
									<td>Keterangan</td>
								</tr>
								<?php foreach ($dataDetail as $dd) : ?>
									<tr>
										<td><?= $dd['kd_pretransaksi'] ?></td>
										<td><?= $dd['nama_barang'] ?></td>
										<td><?= $dd['jumlah'] ?></td>
										<td></td>
										<td></td>
										<!-- <td><?= $dd['harga_barang'] ?></td> -->
										<!-- <td><?= "Rp." . number_format($dd['sub_total']) . ",-" ?></td> -->
									</tr>
								<?php endforeach ?>
								<tr>
									<td colspan="2">Jumlah Pembelian Barang</td>
									<td><?php echo $jumlah_barang['sum'] ?></td>
									<td></td>
								</tr>
								<!-- <tr>
									<td colspan="2"></td>
									<td colspan="2">Total</td>
									<td><?php echo "Rp." . number_format($total['sum']) . ",-" ?></td>
								</tr> -->
							</table>
							<br>
							<p>Tanggal Surat Jalan : <?php echo $dd['tanggal_beli']; ?></p>
							<br>
							<a href="#" class="btn btn-info ds" onclick="window.print()"><i class="fa fa-print"></i> Cetak </a>
							<a href="?" class="btn btn-danger ds">Kembali</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>