<?php
$qb = new lsp();

if (isset($_POST['btnSearch'])) {
	$whereparam = "tanggal_masuk";
	$param      = $_POST['dateAwal'];
	$param1     = $_POST['dateAkhir'];
	$dataB      = $qb->selectBetween("detailbarang", $whereparam, $param, $param1);
	$dataC      = $qb->selectBetween("detailbarangrijek", $whereparam, $param, $param1);
}
?>

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
								<li class="list-inline-item">Laporan Barang Periode</li>
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
				<div class="col-md-12">
					<div class="card">
						<form method="post">
							<div class="card-header">
								<h3>Laporan Barang Periode</h3>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-sm-4">
										<label for="#">Dari Tanggal</label>
										<input value="<?= $_POST['dateAwal'] ?>" class="form-control" type="date" placeholder="Select Date" name="dateAwal" required>
									</div>
									<div class="col-sm-4">
										<label for="#">Ke Tanggal</label>
										<input value="<?= $_POST['dateAkhir'] ?>" class="form-control" type="date" placeholder="Select Date" name="dateAkhir" required>
									</div>
								</div>
								<br>
								<button class="btn btn-dark" name="btnSearch"><i class="fa fa-search"></i> Cari</button>
								<a href="?page=data-barang-periode" class="btn btn-danger">Muat Ulang</a>
								<br><br>
								<?php if (isset($_POST['dateAwal'])) : ?>
									<a target="_blank" href="includes/manager/data-periode-print.php?dateAwal=<?php echo $param ?>&dateAkhir=<?php echo $param1 ?>" class="btn btn-dark"><i class="fa fa-print"></i> Cetak</a>
								<?php endif ?>
								<br><br>
								<table class="table table-striped table-hover table-bordered">
									<thead>
										<tr>
											<th>Kode barang</th>
											<th>Nama barang</th>
											<th>Layout</th>
											<th>Satuan</th>
											<th>Supplier</th>
											<th>Tanggal Masuk</th>
											<th>Harga</th>
											<th>Stok</th>
										</tr>
									</thead>
									<tbody>
										<?php
										if (!empty($dataB)) {
											foreach (@$dataB['data'] as $ds) {
												if ($ds['status'] == "Approved") { ?>
													<tr>
														<td><?= $ds['kd_barang'] ?></td>
														<td><?= $ds['nama_barang'] ?></td>
														<td><?= $ds['layout'] ?></td>
														<td><?= $ds['satuan'] ?></td>
														<td><?= $ds['nama_supplier'] ?></td>
														<td><?= date_ind($ds['tanggal_masuk']) ?></td>
														<td><?= number_format($ds['harga_barang']) ?></td>
														<td><?= $ds['stok_barang'] ?></td>
													</tr>
											<?php }
											} ?>
										<?php } else { ?>
											<tr>
												<td colspan="8" class="text-center">Tidak Ada Data Barang Masuk</td>
											</tr>
										<?php } ?>
										<?php
										if (!empty($dataC)) {
											foreach (@$dataC['data'] as $dsr) {
												if ($dsr['status'] == "Approved") { ?>
													<tr>
														<td><?= $dsr['kd_barang'] ?></td>
														<td><?= $dsr['nama_barang'] ?></td>
														<td><?= $dsr['layout'] ?></td>
														<td><?= $dsr['satuan'] ?></td>
														<td><?= $dsr['nama_supplier'] ?></td>
														<td><?= date_ind($dsr['tanggal_masuk']) ?></td>
														<td><?= number_format($dsr['harga_barang']) ?></td>
														<td><?= $dsr['stok_barang'] ?></td>
													</tr>
											<?php }
											} ?>
										<?php } else { ?>
											<tr>
												<td colspan="8" class="text-center">Tidak Ada Data Barang Rijek</td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
								<div class="float-right text-center mt-3">
									<p>Tegal, <?= date_ind(date("Y-m-d")); ?></p>
									<div class="mt-2">
										<p class="pb-5">Penanggung Jawab</p>
										<p class="py-3">( <?= $auth['nama_user'] ?> )</p>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>