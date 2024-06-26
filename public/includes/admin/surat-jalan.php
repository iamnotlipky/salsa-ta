<?php

$spj  = new lsp();
$id = $_GET['id'];
$data   = $spj->edit("transaksi", "kd_transaksi", $id);
$total  = $spj->selectSumWhere("transaksi", "sub_total", "kd_transaksi='$id'");
$dataDetail = $spj->edit("detailTransaksi", "kd_transaksi", $id);
$jumlah_barang = $spj->selectSumWhere("transaksi", "jumlah", "kd_transaksi='$id'");
$detailTrans = $spj->selectWhere("table_transaksi", "kd_transaksi", $id);

if (isset($_POST['btn-approve'])) {
	$kd_transaksi   = $spj->validateHtml($_POST['kd_transaksi']);
	$status    		= $spj->validateHtml($_POST['status']);

	$value = "kd_transaksi='$kd_transaksi',status='$status'";
	$response = $spj->update("table_transaksi", $value, "kd_transaksi", $id, "?page=surat-jalan&id=$id");
}

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
			margin-top: 225px;
		}

		.hd {
			display: none;
		}
	}
</style>

<!-- BREADCRUMB-->
<section class="au-breadcrumb m-t-75 print-sid">
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
								<li class="list-inline-item">Surat Perintah Jalan</li>
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
				<div class="col-md-8">
					<div class="card">
						<div class="card-body">
							<div class="row mb-3">
								<div class="col-6">
									<h4>Surat Perintah Jalan</h4>
									<p>PT Semen Indonesia Distributor</p>
								</div>
								<div class="col-6">
									<img src="assets/img/icon/logo-sid.webp" alt="logo" class="w-75 float-right">
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">Nomor SPJ : <?php echo $id ?></div>
								<div class="col-sm-6">
									<p class="text-right"><span><?php echo "Tanggal Cetak : " . date("Y-m-d"); ?></p>
								</div>
							</div>
							<br>
							<div class="table-responsive">
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
											<td><?= $dd['satuan'] ?></td>
											<td></td>
											<!-- <td><?= $dd['harga_barang'] ?></td> -->
											<!-- <td><?= "Rp." . number_format($dd['sub_total']) . ",-" ?></td> -->
										</tr>
									<?php endforeach ?>
									<tr>
										<td colspan="4">Jumlah Pembelian Barang</td>
										<td><?php echo $jumlah_barang['sum'] ?></td>
									</tr>
									<!-- <tr>
									<td colspan="2"></td>
									<td colspan="2">Total</td>
									<td><?php echo "Rp." . number_format($total['sum']) . ",-" ?></td>
								</tr> -->
								</table>
							</div>
							<p class="mt-4 mb-3">Nama Supir Armada / Nomor Plat Armada : <?= $detailTrans['supir_armada']; ?> / <?= $detailTrans['nomor_armada']; ?></p>
							<div class="table-responsive">
								<table class="table table-striped table-bordered" width="100%">
									<tr>
										<td>Nama Customer</td>
										<td>Kontak Customer</td>
										<td>Alamat Customer</td>
									</tr>
									<tr>
										<td><?= $detailTrans['nama_cust']; ?></td>
										<td><?= $detailTrans['kontak_cust']; ?></td>
										<td><?= $detailTrans['alamat_cust']; ?></td>
									</tr>
								</table>
							</div>
							<p class="text-right my-3">Tanggal SPJ : <?php echo $dd['tanggal_beli']; ?></p>
							<br>
							<form method="post">
								<input type="text" name="kd_transaksi" class="form-control" value="<?= $id; ?>" hidden>
								<input type="text" name="status" class="form-control" value="Approved" hidden>
								<?php if ($detailTrans['status'] == "Unapproved" && $_SESSION['level'] == "Manager") : ?>
									<button type="submit" class="btn btn-success" name="btn-approve"><i class="fa fa-check"></i> Approve </button>
								<?php endif; ?>
								<?php if ($detailTrans['status'] == "Approved") : ?>
									<a href="#" class="btn btn-info ds" onclick="window.print()"><i class="fa fa-print"></i> Cetak</a>
								<?php endif; ?>
								<a href="?page=data-barang-keluar" class="btn btn-danger ds">Kembali</a>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>