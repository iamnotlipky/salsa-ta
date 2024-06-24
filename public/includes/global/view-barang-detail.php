<?php

$dt = new lsp();
$detail = $dt->selectWhere("detailBarang", "kd_barang", $_GET['id']);
if ($_SESSION['level'] != "Checker" && $_SESSION['level'] != "Admin" && $_SESSION['level'] != "Manager") {
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
								<li class="list-inline-item active"><?= $auth['level']; ?></li>
								<li class="list-inline-item seprate">
									<span>/</span>
								</li>
								<li class="list-inline-item">Detail Barang</li>
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
				<div class="col-md-4">
					<div class="card">
						<div class="card-header">
							<h4><?= $detail['nama_barang'] ?></h4>
						</div>
						<div class="card-body">
							<img style="min-height: 200px; width: 100%; display: block;" src="img/<?php echo $detail['gambar'] ?>" alt="User">
						</div>
					</div>
					<a href="?page=data-barang-masuk" class="btn btn-danger"><i class="fa fa-repeat"></i> Kembali</a>
				</div>
				<div class="col-md-8">
					<div class="card">
						<div class="card-header">
							<h3>Detail Barang</h3>
						</div>
						<div class="card-body">
							<table class="table" cellpadding="10">
								<tr>
									<td>Kode Barang</td>
									<td>:</td>
									<td style="font-weight: bold; color: red;"><?php echo $detail['kd_barang']; ?></td>
								</tr>
								<tr>
									<td>Nama Barang</td>
									<td>:</td>
									<td><?php echo $detail['nama_barang']; ?></td>
								</tr>
								<tr>
									<td>Lokasi</td>
									<td>:</td>
									<td><?php echo $detail['lokasi']; ?></td>
								</tr>
								<tr>
									<td>Supplier</td>
									<td>:</td>
									<td><?php echo $detail['nama_supplier']; ?></td>
								</tr>
								<tr>
									<td>Tanggal Masuk</td>
									<td>:</td>
									<td><?php echo $detail['tanggal_masuk']; ?></td>
								</tr>
								<tr>
									<td>Harga</td>
									<td>:</td>
									<td><?php echo "Rp." . number_format($detail['harga_barang']) . "-,"; ?></td>
								</tr>
								<tr>
									<td>Stok</td>
									<td>:</td>
									<td><?php echo $detail['stok_barang'] ?></td>
								</tr>
								<tr>
									<td>Keterangan</td>
									<td>:</td>
									<td><?php echo $detail['keterangan'] ?></td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>