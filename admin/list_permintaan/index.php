<?php
$base = "http://localhost/inventorymanagement/";

include '../../config.php';

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
					<a class="navbar-brand" href="<?php echo $base; ?>admin"><span>Perusahaan Gula</span></a>
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
			<li class="active">
				<?php 
				$notif_minta_apd = mysqli_query($conn, "SELECT status_permintaan FROM permintaan WHERE status_permintaan='Belum Disetujui'") or die(mysqli_error());
				$not_apd = mysqli_fetch_array($notif_minta_apd);

				if ($not_apd['status_permintaan'] == 'Belum Disetujui') { ?>
					<a href="../list_permintaan"><em class="fa fa-envelope-open">&nbsp;</em> Permintaan APD&nbsp;<span class="label label-danger">!</span></a>
				<?php } else {?>
					<a href="../list_permintaan"><em class="fa fa-envelope-open">&nbsp;</em> Permintaan APD</a>
				<?php } ?>
			</li>
			<li><a href="../riwayat_penerimaan"><em class="fa fa-envelope-open">&nbsp;</em> Penerimaan</a></li>
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
			<li class="parent ">
				<a data-toggle="collapse" href="#sub-item-1">
					<em class="fa fa-navicon">&nbsp;</em> Kalkulator <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-1">
					<li><a class="" href="../kalkulator/hitung.php">
						<span class="fa fa-arrow-right">&nbsp;</span> Hitung
					</a></li>
					<li><a class="" href="../kalkulator/hasil.php">
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
				<li class="active">Permintaan Alat Pelindung Diri</li>
			</ol>
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Permintaan APD</h1>
			</div>
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<p>Tanggal : <?php echo date("d-m-Y"); ?></p>
				<table class="table-read" border="2">
					<tr>
						<th>Tanggal Permintaan</th>
						<th>Nama Karyawan</th>
						<th>Keterangan</th>
					</tr>

					<?php
					$nama_tanggal = mysqli_query($conn, "SELECT karyawan.nip, karyawan.nama_karyawan, permintaan.tanggal_permintaan, permintaan.status_permintaan FROM karyawan JOIN permintaan WHERE karyawan.nip = permintaan.nip_karyawan group by karyawan.nama_karyawan ASC, SUBSTRING(permintaan.tanggal_permintaan,7,10) DESC, SUBSTRING(permintaan.tanggal_permintaan,4,5) DESC, SUBSTRING(permintaan.tanggal_permintaan,1,2) DESC");

					$storeArrayTanggal = Array();
					$storeArrayNama = Array();

					while($row = mysqli_fetch_array($nama_tanggal)){ ?>					

					<tr>
						<form method="POST" action="detail.php">
							<td class="td-read"><?php echo $row['tanggal_permintaan']; ?></td>
							<td class="td-read"><?php echo $row['nama_karyawan']; ?></td>
							<td class="td-read">
								<input type="hidden" name="nip" value="<?php echo $row['nip']; ?>">
								<input type="hidden" name="tanggal" value="<?php echo $row['tanggal_permintaan']; ?>">
								<input type="hidden" name="nama" value="<?php echo $row['nama_karyawan']; ?>">

								<?php if ($row['status_permintaan'] == 'Belum Disetujui') { ?>
									<a><button style="margin: 7px;" class="btn btn-sm btn-primary">Detail</button></a>
								<?php }elseif ($row['status_permintaan'] == 'Disetujui') { ?>
									<a><button style="margin: 7px;" class="btn btn-sm btn-warning">APD Belum Diberikan</button></a>
								<?php } elseif ($row['status_permintaan'] == 'Ditolak') { ?>
									<a><button style="margin: 7px;" class="btn btn-sm btn-danger">Ditolak</button></a>
								<?php } elseif ($row['status_permintaan'] == 'Sudah Diterima') { ?>
									<a><button style="margin: 7px;" class="btn btn-sm btn-success" disabled="">APD Telah Diberikan</button></a>
								<?php } ?>
								
								
							</td>
						</form>
					</tr>
					<?php } ?>
				</table>
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
		};
	</script>

</body>
</html>