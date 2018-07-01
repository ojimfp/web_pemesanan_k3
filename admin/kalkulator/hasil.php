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
	<link href="<?php echo $base; ?>assets/admin/css/dropdown.css" rel="stylesheet">

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

			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">Riwayat Perhitungan</h1>
				</div>
			</div><!--/.row-->

			<div class="row">
				<div class="col-lg-12">
					<table class="table-read" border="2">
						<tr>
							<th>No</th>
							<th>Jenis APD</th>
							<th>Tanggal Hitung</th>
							<th>EOQ</th>
							<th>Frekuensi</th>
							<th>Safety Stock</th>
							<th>ROP</th>
						</tr>
						<?php
						$read_data = mysqli_query($connn, "SELECT * FROM hasil") or die(mysqli_error());
						$no = 1;
						while ($data = mysqli_fetch_array($read_data)) { 
							?>
							<tr>
								<td class="td-read"><?php echo $no; ?></td>
								<td class="td-read"><?php echo $data['jenis_apd']; ?></td>
								<td class="td-read"><?php echo $data['tgl_hitung']; ?></td>
								<td class="td-read"><?php echo $data['eoq']; ?></td>
								<td class="td-read"><?php echo $data['frekuensi']; ?></td>
								<td class="td-read"><?php echo $data['safety_stock']; ?></td>
								<td class="td-read"><?php echo $data['rop']; ?></td>
							</tr>
						<?php $no++; } ?>
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

</body>
</html>
