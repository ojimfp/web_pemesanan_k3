<?php
$base = "http://localhost/inventorymanagement/";

include '../config.php';
include '../calc_conf.php';

session_start();

// cek apakah user telah login, jika belum login maka di alihkan ke halaman login
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
<body>
	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span></button>
					<a class="navbar-brand" href="#"><span>PG Kebon Agung</span></a>
					<ul class="nav navbar-top-links navbar-right">				
					</ul>
				</div>
			</div><!-- /.container-fluid -->
		</nav>
		<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<ul class="nav menu">
			<li class="active"><a href="../admin"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
			<li><a href="tambah_pekerja"><em class="fa fa-user-plus">&nbsp;</em> Tambah Pekerja</a></li>
			<li><a href="list_pekerja"><em class="fa fa-users">&nbsp;</em> List Pekerja</a></li>
			<li><a href="tambah_apd"><em class="fa fa-clone">&nbsp;</em> Tambah Jenis APD</a></li>
			<li><a href="list_apd"><em class="fa fa-database">&nbsp;</em> List Data APD</a></li>
			<li>
				<?php 
				$notif_minta_apd = mysqli_query($conn, "SELECT status_permintaan FROM permintaan WHERE status_permintaan='Belum Disetujui'") or die(mysqli_error());
				$not_apd = mysqli_fetch_array($notif_minta_apd);

				if ($not_apd['status_permintaan'] == 'Belum Disetujui') { ?>
					<a href="list_permintaan"><em class="fa fa-envelope-open">&nbsp;</em> Permintaan APD&nbsp;<span class="label label-danger">!</span></a>
				<?php } else {?>
					<a href="list_permintaan"><em class="fa fa-envelope-open">&nbsp;</em> Permintaan APD</a>
				<?php } ?>
			</li>
			<li>
				<?php 
				$notif_minta_apd = mysqli_query($conn, "SELECT status_peminjaman FROM peminjaman WHERE status_peminjaman='Belum Disetujui'") or die(mysqli_error());
				$not_apd = mysqli_fetch_array($notif_minta_apd);

				if ($not_apd['status_peminjaman'] == 'Belum Disetujui') { ?>
					<a href="peminjaman"><em class="fa fa-envelope-open">&nbsp;</em> Peminjaman APD&nbsp;<span class="label label-danger">!</span></a>
				<?php } else {?>
					<a href="peminjaman"><em class="fa fa-envelope-open">&nbsp;</em> Peminjaman APD</a>
				<?php } ?>
			</li>
			<li><a href="list_pengadaan"><em class="fa fa-plus">&nbsp;</em> Pengadaan APD</a></li>
			<li><a href="ganti_password"><em class="fa fa-plus">&nbsp;</em> Ganti Password</a></li>
			<li class="parent "><a data-toggle="collapse" href="#sub-item-1">
				<em class="fa fa-navicon">&nbsp;</em> Kalkulator <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-1">
					<li><a class="" href="kalkulator/hitung.php">
						<span class="fa fa-arrow-right">&nbsp;</span> Hitung
					</a></li>
					<li><a class="" href="kalkulator/hasil.php">
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
				<li class="active">Dashboard</li>
			</ol>
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12">

				<?php
					// $rop = mysqli_query($connn, "SELECT jenis_apd, rop FROM hasil ORDER BY tgl_hitung asc");

					$warning = mysqli_query($conn, "SELECT apd.id_apd, apd.nama_apd, apd.gambar_apd, stock.jumlah_stock FROM apd LEFT JOIN stock ON apd.id_apd=stock.id_apd WHERE apd.id_apd = stock.jumlah_stock IS NULL OR stock.id_pengadaan = (SELECT id_pengadaan FROM stock ORDER BY id_pengadaan DESC LIMIT 1)") or die(mysqli_error());

					while ($wr = mysqli_fetch_array($warning)) {
						if (substr($wr['nama_apd'],0,10) == "Baju Kerja") {
							$jumlah_baju_kerja[] = $wr['jumlah_stock'];
						} elseif (substr($wr['nama_apd'],0,16) == "Pelindung Tangan") {
							$jumlah_pelindung_tangan[] = $wr['jumlah_stock'];
						} elseif (substr($wr['nama_apd'],0,13) == "Safety Helmet") {
							$jumlah_safety_helmet[] = $wr['jumlah_stock'];
						} elseif (substr($wr['nama_apd'],0,6) == "Masker") {
							$jumlah_masker[] = $wr['jumlah_stock'];
						} elseif (substr($wr['nama_apd'],0,12) == "Safety Shoes") {
							$jumlah_safety_shoes[] = $wr['jumlah_stock'];
						} elseif (substr($wr['nama_apd'],0,17) == "Pelindung Telinga") {
							$jumlah_pelindung_telinga[] = $wr['jumlah_stock'];
						}
					}

					if (array_sum($jumlah_baju_kerja) < 59) { ?>
						<div class="alert bg-warning" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Jumlah stock untuk baju kerja mulai menipis.</div>
					<?php } if (array_sum($jumlah_pelindung_tangan) < 59) { ?>
						<div class="alert bg-warning" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Jumlah stock untuk safety gloves/ pelindung tangan mulai menipis.</div>
					<?php } if (array_sum($jumlah_safety_helmet) < 36) { ?>
						<div class="alert bg-warning" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Jumlah stock untuk safety helmet mulai menipis.</div>
					<?php } if (array_sum($jumlah_masker) < 59) { ?>
						<div class="alert bg-warning" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Jumlah stock untuk masker mulai menipis.</div>
					<?php } if (array_sum($jumlah_safety_shoes) < 138) { ?>
						<div class="alert bg-warning" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Jumlah stock untuk safety shoes mulai menipis.</div>
					<?php } if (array_sum($jumlah_pelindung_telinga) < 39) { ?>
						<div class="alert bg-warning" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Jumlah stock untuk pelindung telinga mulai menipis.</div>
					<?php } ?>
			</div>
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-info chat">
					<div class="panel-heading">
						Data APD
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
						<div class="panel-body">

							<div class="row">
								<table style="margin: 0 auto;" border="0">
									<?php 
									$read_data = mysqli_query($conn, "SELECT apd.id_apd, apd.nama_apd, apd.gambar_apd, stock.jumlah_stock FROM apd LEFT JOIN stock ON apd.id_apd=stock.id_apd WHERE apd.id_apd = stock.jumlah_stock IS NULL OR stock.id_pengadaan = (SELECT id_pengadaan FROM stock ORDER BY id_pengadaan DESC LIMIT 1)") or die(mysqli_error()); ?>
									<tr>
										<?php 
										$i = 0;
										while ($data = mysqli_fetch_array($read_data)) { ?>
											<td style="text-align: center; vertical-align: middle;">
												<div class="easypiechart-panel" style="background-color: #f5f5f5; margin: 15px;">

													<h5><?php echo $data['nama_apd']; ?></h5>
													<img style="width: 40px; margin: 10px 60px 10px;" src="<?php echo $base.'assets/img/'.$data['gambar_apd']; ?>">
													<strong>
														<p style="text-align: center; margin-bottom: 50px; font-size: 30px;"><?php echo $data['jumlah_stock']; ?>
														</p>
													</strong>
												</div> 
												<?php 
												$i++;
												if ($i%5 == 0) {
													echo '</td></tr></div><div class="row">';
												}
											} ?>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">SOP Pengendalian Persediaan APD</h1>
			</div>
		</div><!--/.row-->

		<div class="row">
			<div class="container col-lg-12">
				<div class="list-group">
					<form method="POST" action="ganti.php">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<strong>
									SOP Penerimaan Persediaan
								</strong>
							</div>
							<div class="panel-body">
								<div class="row" style="margin: 10px; ">
									<p>Dalam melakukan pengendalian persediaan prosedur yang harus dilakukan dalam proses penerimaan APD adalah sebagai berikut :</p>
									<p>1. Bagian Umum perusahaan menerima barang disertai dengan Nota pembelian APD.</p>
									<p>2. Bagian umum melakukan pengecekan kondisi barang dan jumlah barang yang diterima yang diterima berdasarkan nota pembelian.</p>
									<p>3. Apabila barang yang dipesan telah sesuai dengan kriteria, maka bagian umum memasukkan data pembelian APD pada website perusahaan guna mencatat barang masuk dan sebagai inventory.</p>
									<p>4. Kemudian setelah memasukan data pada website APD diserahkan ke bagian gudang persediaan PG. Kebon Agung.</p>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>

			<div class="container col-lg-12">
				<div class="list-group">
					<form method="POST" action="ganti.php">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<strong>
									SOP Pendistribusian Persediaan APD
								</strong>
							</div>
							<div class="panel-body">
								<div class="row" style="margin: 10px; ">
									<p>Pada proses pendistribusian yang ditujukan kepada pekerja, jenis APD yang dibagikan sesuai dengan ketentuan perusahaan antara bagian pabrik dan bagian umum. Berikut merupakan SOP untuk pendistribusian Alat Pelindung Diri pada PG. Kebon Agung:</p>
									<p>1. APD di bagikan kepada seluruh pekerja yang bekerja di area PG. Kebon Agung sesuai dengan jenis APD yang digunakan untuk setiap bagian di PG. Kebon Agung.</p>
									<p>2. Sebelum melakukan pengambilan APD pekerja wajib mengisi form permintaan APD di website inventory management.</p>
									<p>3. Setelah mengisi formulir permintaan pada website, pekerja datang ke bagian gudang untuk meminta APD yang telah diisi pada form permintaan pada website.</p>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>

			<div class="container col-lg-12">
				<div class="list-group">
					<form method="POST" action="ganti.php">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<strong>
									SOP Pemesanan Persediaan
								</strong>
							</div>
							<div class="panel-body">
								<div class="row" style="margin: 10px; ">
									<p>Pemesanan persediaan dilakukan untuk memenuhi kebutuhan persediaan APD yang dibutuhkan, sehingga tidak menggagu kegiatan operasional perusahaan. Berikut merupakan SOP pemesanan persediaan :</p>
									<p>1. Jumlah kebutuhan persediaan yang dipesan harus sesuai dengan hasil perhitungan web calculator yang telah di sediakan sehingga dari masing masing APD  dapat terpenuhi kebutuhannya.</p>
									<p>2. Dalam melakukan pemesanan wajib memperhatikan jumlah kebutuhan yang tertera pada web calculator, mulai dari jumlah yang harus dipesan hingga titik pemesanan kembali / reorder point.</p>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="<?php echo $base; ?>assets/admin/js/jquery-1.11.1.min.js"></script>
<script src="<?php echo $base; ?>assets/admin/js/bootstrap.min.js"></script>
<script src="<?php echo $base; ?>assets/admin/js/chart.min.js"></script>
<script src="<?php echo $base; ?>assets/admin/js/chart-data.js"></script>
<script src="<?php echo $base; ?>assets/admin/js/easypiechart.js"></script>
<script src="<?php echo $base; ?>assets/admin/js/easypiechart-data.js"></script>
<script src="<?php echo $base; ?>assets/admin/js/bootstrap-datepicker.js"></script>
<script src="<?php echo $base; ?>assets/admin/js/custom.js"></script>
	<script>
	window.onload = function () {
	var chart1 = document.getElementById("line-chart").getContext("2d");
	window.myLine = new Chart(chart1).Line(lineChartData, {
	responsive: true,
	scaleLineColor: "rgba(0,0,0,.2)",
	scaleGridLineColor: "rgba(0,0,0,.05)",
	scaleFontColor: "#c5c7cc"
	});
	var chart2 = document.getElementById("bar-chart").getContext("2d");
	window.myBar = new Chart(chart2).Bar(barChartData, {
	responsive: true,
	scaleLineColor: "rgba(0,0,0,.2)",
	scaleGridLineColor: "rgba(0,0,0,.05)",
	scaleFontColor: "#c5c7cc"
	});
	var chart3 = document.getElementById("doughnut-chart").getContext("2d");
	window.myDoughnut = new Chart(chart3).Doughnut(doughnutData, {
	responsive: true,
	segmentShowStroke: false
	});
	var chart4 = document.getElementById("pie-chart").getContext("2d");
	window.myPie = new Chart(chart4).Pie(pieData, {
	responsive: true,
	segmentShowStroke: false
	});
	var chart5 = document.getElementById("radar-chart").getContext("2d");
	window.myRadarChart = new Chart(chart5).Radar(radarData, {
	responsive: true,
	scaleLineColor: "rgba(0,0,0,.05)",
	angleLineColor: "rgba(0,0,0,.2)"
	});
	var chart6 = document.getElementById("polar-area-chart").getContext("2d");
	window.myPolarAreaChart = new Chart(chart6).PolarArea(polarData, {
	responsive: true,
	scaleLineColor: "rgba(0,0,0,.2)",
	segmentShowStroke: false
	});
};
	</script>

</body>
</html>