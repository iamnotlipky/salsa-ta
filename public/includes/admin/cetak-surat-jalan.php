<?php

$pem       = new lsp();
$transkode = $pem->autokode("table_transaksi", "kd_transaksi", "TR");
$sql       = "SELECT SUM(sub_total) as sub FROM table_pretransaksi WHERE kd_transaksi = '$transkode'";
$exec      = mysqli_query($con, $sql);
$assoc     = mysqli_fetch_assoc($exec);
$sql1      = "SELECT SUM(jumlah) as jum FROM table_pretransaksi WHERE kd_transaksi = '$transkode'";
$exec1     = mysqli_query($con, $sql1);
$assoc1    = mysqli_fetch_assoc($exec1);
$auth      = $pem->selectWhere("table_user", "username", $_SESSION['username']);
$sql2      = "SELECT COUNT(kd_pretransaksi) as count FROM table_pretransaksi WHERE kd_transaksi = '$transkode'";
$exec2     = mysqli_query($con, $sql2);
$assoc2    = mysqli_fetch_assoc($exec2);

if ($assoc2['count'] <= 0) {
	header("location:admin-panel.php?page=input-barang-keluar");
}

if (isset($_POST['selesaiGet'])) {
	$total				= $_POST['tot'];
	$date  				= date("Y-m-d");
	$nama_cust  		= $pem->validateHtml($_POST['nama_cust']);
	$kontak_cust  		= $pem->validateHtml($_POST['kontak_cust']);
	$alamat_cust  		= $pem->validateHtml($_POST['alamat_cust']);
	$nomor_armada  		= $pem->validateHtml($_POST['nomor_armada']);
	$supir_armada  		= $pem->validateHtml($_POST['supir_armada']);
	$status  		= $pem->validateHtml($_POST['status']);
	// $bayar  = $_POST['bayar'];
	// $kem    = $_POST['kem'];

	$value = "'$transkode','$auth[kd_user]','$assoc1[jum]','$assoc[sub]','$date','$nama_cust','$kontak_cust','$alamat_cust','$nomor_armada','$supir_armada','$status'";
	$response = $pem->insert("table_transaksi", $value, "?page=surat-jalan&id=$transkode");
	if ($response['response'] == "positive") {
		unset($_SESSION['transaksi']);
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
								<li class="list-inline-item active"><?= $auth['level']; ?></li>
								<li class="list-inline-item seprate">
									<span>/</span>
								</li>
								<li class="list-inline-item">Cetak Surat Perintah Jalan</li>
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
				<div class="col-md-6 col-sm-12">
					<div class="card">
						<div class="card-header">
							<h3>Cetak Surat Perintah Jalan</h3>
						</div>
						<div class="card-body">
							<form method="post">
								<div class="col-sm-12">
									<div class="form-group">
										<label for="">Kode Transaksi</label>
										<input type="text" class="form-control" name="autokode" id="autokode" value="<?php echo $transkode ?>" readonly>
									</div>
									<div class="form-group">
										<label for="">Total harga</label>
										<input type="text" class="form-control" name="tot" id="tot" value="<?php echo $assoc['sub'] ?>" readonly>
									</div>
									<div class="form-group">
										<label for="">Nama Customer</label>
										<input type="text" class="form-control" name="nama_cust" required>
									</div>
									<div class="form-group">
										<label for="">Kontak Customer</label>
										<input type="text" class="form-control" name="kontak_cust" required>
									</div>
									<div class="form-group">
										<label for="">Alamat Customer</label>
										<input type="text" class="form-control" name="alamat_cust" required>
									</div>
									<div class="form-group">
										<label for="">Plat Nomor Armada</label>
										<input type="text" class="form-control" name="nomor_armada" required>
									</div>
									<div class="form-group">
										<label for="">Nama Supir Armada</label>
										<input type="text" class="form-control" name="supir_armada" required>
									</div>
									<div class="form-group">
										<input type="text" class="form-control" name="status" value="Unapproved" hidden readonly>
									</div>
									<!-- <div class="form-group">
										<label for="">Bayar</label>
										<input type="text" class="form-control" name="bayar" id="bayar">
									</div>
									<div class="form-group">
										<label for="">Kembalian</label>
										<input type="text" class="form-control" name="kem" id="kem" readonly="">
									</div> -->
									<button class="btn btn-primary" name="selesaiGet"><i class="fa fa-cart-plus"></i> Lanjutkan</button>
									<a href="?page=input-barang-keluar" class="btn btn-danger"><i class="fa fa-repeat"></i> Kembali</a>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<script src="assets/vendor/jquery-3.2.1.min.js"></script>
<script>
	$(document).ready(function() {
		$('#jumjum').keyup(function() {
			var jumlah = $(this).val();
			var harba = $('#harba').val();
			var kali = harba * jumlah;
			$("#totals").val(kali);
		});

		$('#bayar').keyup(function() {
			var bayar = $(this).val();
			var total = $('#tot').val();
			var kembalian = bayar - total;
			$('#kem').val(kembalian);
		});
	})
</script>