<?php
$br = new lsp();
if ($_SESSION['level'] != "Admin") {
	header("location:index.php");
}
$table    = "table_barang";
$data     = $br->selectWhere($table, "kd_barang", $_GET['id']);
$getLokasi = $br->select("table_lokasi");
$getSatuan = $br->select("table_satuan");
$getDistr = $br->select("table_supplier");
$waktu    = date("Y-m-d");
if (isset($_POST['edit-barang'])) {
	$kode_barang  = $br->validateHtml($_POST['kode_barang']);
	$nama_barang  = $br->validateHtml($_POST['nama_barang']);
	$lokasi_barang = $br->validateHtml($_POST['lokasi_barang']);
	$satuan  = $br->validateHtml($_POST['satuan']);
	$supplier  = $br->validateHtml($_POST['supplier']);
	$harga        = $br->validateHtml($_POST['harga']);
	$stok         = $br->validateHtml($_POST['stok']);
	$ket          = $_POST['ket'];

	if ($kode_barang == " " || $nama_barang == " " || $lokasi_barang == " " || $satuan == " " || $supplier == " " || $harga == " " || $stok == " " || $ket == " ") {
		$response = ['response' => 'negative', 'alert' => 'Lengkapi Formulir!'];
	} else {
		if ($harga < 0 || $stok < 0) {
			$response = ['response' => 'negative', 'alert' => 'Harga atau Stok Tidak Boleh Kurang dari Nol!'];
		} else {
			if ($_FILES['foto']['name'] == "") {
				$value = "kd_barang='$kode_barang',nama_barang='$nama_barang',kd_lokasi='$lokasi_barang',kd_satuan='$satuan',kd_supplier='$supplier',tanggal_masuk='$waktu',harga_barang='$harga',stok_barang='$stok',keterangan='$ket'";
				$response = $br->update($table, $value, "kd_barang", $_GET['id'], "?page=data-barang-masuk");
			} else {
				$response = $br->validateImage();
				if ($response['types'] == "true") {
					$value = "kd_barang='$kode_barang',nama_barang='$nama_barang',kd_lokasi='$lokasi_barang',kd_satuan='$satuan',kd_supplier='$supplier',tanggal_masuk='$waktu',harga_barang='$harga',stok_barang='$stok',keterangan='$ket',gambar='$response[image]'";
					$response = $br->update($table, $value, "kd_barang", $_GET['id'], "?page=data-barang-masuk");
				} else {
					$response = ['response' => 'negative', 'alert' => 'gambar error'];
				}
			}
		}
	}
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
									<a href="#">Admin</a>
								</li>
								<li class="list-inline-item seprate">
									<span>/</span>
								</li>
								<li class="list-inline-item">Edit Data Barang </li>
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
					<form method="post" enctype="multipart/form-data">
						<div class="card">
							<div class="au-card-title">
								<div class="bg-overlay bg-overlay--blue"></div>
								<h3>
									<i class="zmdi zmdi-account-calendar"></i>Edit Data Barang
								</h3>
							</div>
							<div class="card-body">
								<div class="col-12">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="">Kode barang</label>
												<input type="text" class="form-control" name="kode_barang" value="<?php echo $data['kd_barang']; ?>" readonly>
											</div>
											<div class="form-group">
												<label for="">Nama barang</label>
												<input type="text" class="form-control" name="nama_barang" value="<?php echo @$data['nama_barang'] ?>">
											</div>
											<div class="form-group">
												<label for="">Lokasi</label>
												<select name="lokasi_barang" class="form-control">
													<option value=" ">Pilih Lokasi</option>
													<?php foreach ($getLokasi as $mr) { ?>
														<?php if ($mr['kd_lokasi'] == $data['kd_lokasi']) { ?>
															<option value="<?= $mr['kd_lokasi'] ?>" selected><?= $mr['lokasi'] ?></option>
														<?php } else { ?>
															<option value="<?= $mr['kd_lokasi'] ?>"><?= $mr['lokasi'] ?></option>
														<?php } ?>
													<?php } ?>
												</select>
											</div>
											<div class="form-group">
												<label for="">Satuan</label>
												<select name="satuan" class="form-control">
													<option value=" ">Pilih Satuan</option>
													<?php foreach ($getSatuan as $st) { ?>
														<?php if ($st['kd_satuan'] == $data['kd_satuan']) { ?>
															<option value="<?= $st['kd_satuan'] ?>" selected><?= $st['satuan'] ?></option>
														<?php } else { ?>
															<option value="<?= $sd['kd_satuan'] ?>"><?= $mr['satuan'] ?></option>
														<?php } ?>
													<?php } ?>
												</select>
											</div>
											<div class="form-group">
												<label for="">Supplier</label>
												<select name="supplier" class="form-control">
													<option value=" ">Pilih supplier</option>
													<?php foreach ($getDistr as $dr) { ?>
														<?php if ($dr['kd_supplier'] == $data['kd_supplier']) { ?>
															<option value="<?= $dr['kd_supplier'] ?>" selected><?= $dr['nama_supplier'] ?></option>
														<?php } else { ?>
															<option value="<?= $dr['kd_supplier'] ?>"><?= $dr['nama_supplier'] ?></option>
														<?php } ?>
													<?php } ?>
												</select>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="">Harga barang</label>
												<input type="number" class="form-control" name="harga" value="<?php echo $data['harga_barang'] ?>">
											</div>
											<div class="form-group">
												<label for="">Stok barang</label>
												<input type="number" class="form-control" name="stok" value="<?php echo $data['stok_barang'] ?>">
											</div>
											<div class="form-group">
												<label for="">Keterangan</label>
												<input type="text" class="form-control" name="ket" value="<?php echo $data['keterangan'] ?>">
											</div>
											<div class="form-group" id="fotoF">
												<label for="">Foto</label>
												<div class="row">
													<div class="col-6">
														<input type="file" name="foto" id="gambar" class="form-control-file">
													</div>
													<div class="col-6">
														<div>
															<img style="margin-top: -20px;" alt="" src="img/<?= $data['gambar'] ?>" width="120" class="img-responsive" id="pict">
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="card-footer">
								<button name="edit-barang" class="btn btn-primary"><i class="fa fa-download"></i> Konfirmasi</button>
								<a href="?page=data-barang-masuk" class="btn btn-danger"><i class="fa fa-repeat"></i> Kembali</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>