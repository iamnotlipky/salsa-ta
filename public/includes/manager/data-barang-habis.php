<?php
$qb = new lsp();
$dataB = $qb->edit("detailbarang", "stok_barang", 0);
if (isset($_GET['export'])) {
	$dateNow = date("Y-m-d");
	header("Content-type:application/vnd-ms-excel");
	header("Content-Disposition:attachment;filename='$dateNow'-databaranghabis.xls");
}
?>

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

<section class="au-breadcrumb m-t-75 hd">
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
								<li class="list-inline-item">Data Barang Habis</li>
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
				<div class="col-sm-12 mb-5" style="background: white; padding: 50px;">
					<div class="row">
						<div class="col-6">
							<h3>Data Barang Habis</h3>
							<span>PT Semen Indonesia Distributor</span>
						</div>
						<div class="col-6 text-right">
							<img src="../../assets/img/icon/logo.png" alt="logo" class="w-50 text-right">
						</div>
					</div>
					<!-- <button class="btn btn-primary"><a href="pages/manager/BarangHabisPrint.php" style="color: white;">Export Excel</a></button> -->
					<button class="btn btn-dark" onclick="window.print()">Cetak</button>
					<p class="text-right my-3">Tanggal Cetak : <?= date("Y-m-d"); ?></p>
					<div class="table-responsive">
						<table class="table table-striped table-bordered" style="width:100%">
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
							<t>
								<?php if (!empty($dataB)) : ?>
									<?php
									$no = 1;
									foreach ($dataB as $ds) { ?>
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
								<?php else : ?>
									<tr>
										<td colspan="8" class="text-center">Tidak Ada Data</td>
									</tr>
								<?php endif; ?>
							</t>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>