<?php
$qb = new lsp();
$dataB = $qb->select("detailbarang");
if ($_SESSION['level'] != "Manager") {
	header("location:index.php");
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
								<li class="list-inline-item">Dashboard</li>
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
						<div class="card-header">
							<h3>Semua Barang</h3>
							<br>
							<!-- <a href="manager/export.php" name="export" class="btn btn-success" target="_blank">Export Excel</a> -->
							<a href="?page=all-data-barang" target="_blank" class="btn btn-info">Print</a>
						</div>
						<div class="card-body">
							<table class="table table-hover table-bordered" id="sampleTable">
								<thead>
									<tr>
										<th>Kode barang</th>
										<th>Nama barang</th>
										<th>Lokasi</th>
										<th>Supplier</th>
										<th>Tanggal Masuk</th>
										<th>Harga</th>
										<th>Stok</th>
										<th>Satuan</th>
										<th>Action</th>
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
											<td><?= $ds['nama_supplier'] ?></td>
											<td><?= $ds['tanggal_masuk'] ?></td>
											<td><?= number_format($ds['harga_barang']) ?></td>
											<td><?= $ds['stok_barang'] ?></td>
											<td><?= $ds['satuan'] ?></td>
											<td class="text-center">
												<a href="?page=view-barang-detail&id=<?php echo $ds['kd_barang'] ?>" class="btn btn-warning"><i class="fa fa-search"></i></a>
											</td>
										</tr>
									<?php $no++;
									} ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>