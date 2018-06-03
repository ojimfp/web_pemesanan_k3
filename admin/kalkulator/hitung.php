<?php
$base = "http://localhost/inventorymanagement/";

include '../../calc_conf.php';
include '../../config.php';

session_start();

if($_SESSION['status'] !="login admin"){
	header("location:". $base."login");

}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin - Dashboard</title>
	<link href="<?php echo $base; ?>assets/admin/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo $base; ?>assets/admin/css/font-awesome.min.css" rel="stylesheet">
	<link href="<?php echo $base; ?>assets/admin/css/datepicker3.css" rel="stylesheet">
	<link href="<?php echo $base; ?>assets/admin/css/styles.css" rel="stylesheet">

	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
<![endif]-->
</head>
<body onload="select();">
	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span></button>
					<a class="navbar-brand" href="<?php echo $base; ?>admin"><span>PG Kebon Agung</span></a>
					<ul class="nav navbar-top-links navbar-right">					
					</ul>
				</div>
			</div><!-- /.container-fluid -->
		</nav>

		<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
			<ul class="nav menu">
				<li><a href="../../admin"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
				<li><a href="../tambah_pekerja"><em class="fa fa-user-plus">&nbsp;</em> Tambah Pekerja</a></li>
				<li><a href="../list_pekerja"><em class="fa fa-users">&nbsp;</em> List Pekerja</a></li>
				<li><a href="../tambah_apd"><em class="fa fa-clone">&nbsp;</em> Tambah Jenis APD</a></li>
				<li><a href="../list_apd"><em class="fa fa-database">&nbsp;</em> List Data APD</a></li>
				<li>
					<?php 
					$notif_minta_apd = mysqli_query($conn, "SELECT status_permintaan FROM permintaan WHERE status_permintaan='Belum Disetujui'") or die(mysqli_error());
					$not_apd = mysqli_fetch_array($notif_minta_apd);

					if ($not_apd['status_permintaan'] == 'Belum Disetujui') { ?>
						<a href="../list_permintaan"><em class="fa fa-envelope-open">&nbsp;</em> Permintaan APD&nbsp;<span class="label label-danger">!</span></a>
					<?php } else {?>
						<a href="../list_permintaan"><em class="fa fa-envelope-open">&nbsp;</em> Permintaan APD</a>
					<?php } ?>
				</li>
				<li>
					<?php 
					$notif_minta_apd = mysqli_query($conn, "SELECT status_peminjaman FROM peminjaman WHERE status_peminjaman='Belum Disetujui'") or die(mysqli_error());
					$not_apd = mysqli_fetch_array($notif_minta_apd);

					if ($not_apd['status_peminjaman'] == 'Belum Disetujui') { ?>
						<a href="../peminjaman"><em class="fa fa-envelope-open">&nbsp;</em> Peminjaman APD&nbsp;<span class="label label-danger">!</span></a>
					<?php } else {?>
						<a href="../peminjaman"><em class="fa fa-envelope-open">&nbsp;</em> Peminjaman APD</a>
					<?php } ?>
				</li>
				<li><a href="../list_pengadaan"><em class="fa fa-plus">&nbsp;</em> Pengadaan APD</a></li>
        		<li><a href="../ganti_password"><em class="fa fa-plus">&nbsp;</em> Ganti Password</a></li>
        		<li class="parent active">
        			<a data-toggle="collapse" href="#sub-item-1">
        				<em class="fa fa-navicon">&nbsp;</em> Kalkulator <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
        			</a>
        			<ul class="children collapse" id="sub-item-1">
        				<li><a class="" href="hitung.php">
        					<span class="fa fa-arrow-right">&nbsp;</span> Hitung
        				</a></li>
        				<li><a class="" href="hasil.php">
        					<span class="fa fa-arrow-right">&nbsp;</span> Data
        				</a></li>
        			</ul>
        		</li>
        		<li><a href="<?php echo $base; ?>logout"><em class="fa fa-sign-out">&nbsp;</em> Logout</a></li>
        	</ul>
		</div>

		<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
			<div class="row">
				<ol class="breadcrumb">
					<li><a href="#">
						<em class="fa fa-home"></em>
					</a></li>
					<li class="active">Perhitungan</li>
				</ol>
			</div>

			<div class="container col-lg-6">
				<div class="list-group">
					<form method="POST" action="ganti.php">
						<div class="panel panel-default">
							<div class="panel-heading">
								<strong>
								</strong>
							</div>
							<div class="panel-body">
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>Pilih APD Untuk Dihitung</label>
											<select class="form-control" id="jenis" onclick="select()" required="">
												<?php 
													$read_data = mysqli_query($conn, "SELECT id_apd, nama_apd FROM apd") or die(mysqli_error());
													while ($data = mysqli_fetch_array($read_data)) {
												?>
												<option value="<?php echo $data['nama_apd'] ?>"><?php echo $data['nama_apd'].' -- '.$data['id_apd']; ?></option>
											<?php } ?>
											</select>
										</div>
										<div class="form-group">
											<label>Harga</label>
											<input class="form-control" type="text" name="harga" id="harga" required="" onkeypress="return isNumberKey(event)" autofocus>
										</div>
										<div class="form-group">
											<label>Kebutuhan</label>
											<input class="form-control" type="text" name="kebutuhan" id="kebutuhan" required="" onkeyup="calculate()" onkeypress="return isNumberKey(event)">
										</div>
										<div class="form-group">
											<label>Pemakaian Rata-rata pertahun</label>
											<input class="form-control" type="text" id="rata2" name="rata2" disabled="">
										</div>
										<div class="form-group">
											<label>Lead Time (bulan)</label>
											<input class="form-control" type="text" name="lead_time" id="lead_time" onkeyup="rop()" required="" onkeypress="return isNumberKey(event)">
										</div>
										<!-- <br>
										<br>
										<div class="button-submit">
											<input style="width: 100%; " class="btn btn-md btn-primary" type="submit" name="hitung" value="HITUNG">
										</div>
										<br>
										<br> -->
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>

			<div class="container col-lg-6">
				<div class="list-group">
					
					<div class="panel panel-default">
						<div class="panel-heading">
							<strong>

							</strong>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-12">
									<form method="POST" action="hitung.php">
										<div class="form-group">
											<label>Nama APD</label>
											<input class="form-control" type="text" name="nama" id="nama" readonly="">
										</div>
										<div class="form-group">
											<label>EOQ</label>
											<input class="form-control" type="text" name="eoq" id="eoq" readonly="">
										</div>
										<div class="form-group">
											<label>Frekuensi Pemesanan</label>
											<input class="form-control" type="text" name="frekuensi" id="frekuensi" readonly="">
										</div>
										<div class="form-group">
											<label>Safety Stock</label>
											<input class="form-control" type="text" name="ss" id="ss" readonly="">
										</div>
										<div class="form-group">
											<label>Reorder Point</label>
											<input class="form-control" type="text" name="rop" id="rop" readonly="">
										</div>
										<br>
										<br>
										<div class="button-submit">
											<input style="width: 100%; " class="btn btn-md btn-primary" type="submit" name="simpan" value="SIMPAN">
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="modal fade" tabindex="-1" role="dialog" id="failed">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title alert alert-danger">GAGAL!</h4>
						</div>
						<div class="modal-body">
							<p>Pastikan anda mengisi semua data yang diperlukan..</p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->

		<script src="<?php echo $base; ?>assets/admin/js/jquery-1.11.1.min.js"></script>
		<script src="<?php echo $base; ?>assets/admin/js/bootstrap.min.js"></script>
		<script src="<?php echo $base; ?>assets/admin/js/chart.min.js"></script>
		<script src="<?php echo $base; ?>assets/admin/js/chart-data.js"></script>
		<script src="<?php echo $base; ?>assets/admin/js/easypiechart.js"></script>
		<script src="<?php echo $base; ?>assets/admin/js/easypiechart-data.js"></script>
		<script src="<?php echo $base; ?>assets/admin/js/bootstrap-datepicker.js"></script>
		<script src="<?php echo $base; ?>assets/admin/js/custom.js"></script>
<!-- <script>
	window.onload = function () {
		var chart1 = document.getElementById("line-chart").getContext("2d");
		window.myLine = new Chart(chart1).Line(lineChartData, {
			responsive: true,
			scaleLineColor: "rgba(0,0,0,.2)",
			scaleGridLineColor: "rgba(0,0,0,.05)",
			scaleFontColor: "#c5c7cc"
		});
	};
</script> -->
<script type="text/javascript">
	function isNumberKey(evt){
		var charCode = (evt.which) ? evt.which : event.keyCode
		if(charCode > 31 && (charCode != 46 &&(charCode < 48 || charCode > 57)))
			return false;
		return true;
	}

	function select(){
		var e = document.getElementById("jenis");
		var value = e.options[e.selectedIndex].text;
		document.getElementById('nama').value = value;
	}

	function calculate(){

		// untuk hitung rata-rata pemakaian pertahun
		var keb = document.getElementById('kebutuhan').value;
		var rata = keb / 12;
		document.getElementById('rata2').value = rata;

		// untuk menghitung eoq, ss, Frekuensi
		var harga = document.getElementById('harga').value;
		var hasil = harga * 0.12;
		var hasil1 = harga * 0.05;
		var hasil2 = parseInt(hasil) + parseInt(harga);
		var eoq = Math.sqrt((2*keb*hasil2)/hasil1);
		if (!isNaN(keb / eoq)) {
			var frekuensi = keb / eoq;
		} else {
			var frekuensi = 0;
		}

		if (!isNaN(0.1 * keb)) {
			var ss = 0.1 * keb;
		} else {
			var ss = 0;
		}

		document.getElementById('eoq').value = Math.ceil(eoq);
		document.getElementById('frekuensi').value = Math.ceil(frekuensi);
		document.getElementById('ss').value = Math.ceil(ss);
	}

	function rop(){
		var keb = document.getElementById('kebutuhan').value;
		var rata = keb / 12;

		var rop = (document.getElementById('lead_time').value * rata) + parseInt(0.1 * keb);
		document.getElementById('rop').value = Math.ceil(rop);
	}
</script>

<?php 
if (isset($_POST['simpan'])) {
	$nama = $_POST['nama'];
	$eoq = $_POST['eoq'];
	$frekuensi = $_POST['frekuensi'];
	$ss = $_POST['ss'];
	$rop = $_POST['rop'];
	$tgl = date('d-m-Y');

	if (!empty($nama) && !empty($eoq) && !empty($frekuensi) && !empty($ss) && !empty($rop)) {
		mysqli_query($connn, "INSERT INTO hasil (jenis_apd, tgl_hitung, eoq, frekuensi, safety_stock, rop) VALUES ('$nama','$tgl','$eoq','$frekuensi','$ss','$rop')") or die(mysqli_error());

	echo "<script>location.href='hasil.php';</script>";
	} elseif(empty($nama) || empty($eoq) || empty($frekuensi) || empty($ss) || empty($rop)) {
		echo "<script type='text/javascript'>
			$(window).on('load',function(){
				$('#failed').modal('show');
				});
				</script>";
	}	
}
?>

</body>
</html>