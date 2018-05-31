<?php
$base = "http://localhost/inventorymanagement/";

include '../../config.php';

session_start();

$nip = $_POST['nip'];
$tanggal = $_POST['tanggal'];
	if (isset($_POST['nama'])) {
		$nama = $_POST['nama'];
	} else {
		$nama = ' ';
	}
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
					<a class="navbar-brand" href="<?php echo $base; ?>admin"><span>PG Kebon Agung</span></a>
					<ul class="nav navbar-top-links navbar-right">
						<li class="dropdown">
							<a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
								<em class="fa fa-envelope"></em><span class="label label-danger">15</span>
							</a>
							<ul class="dropdown-menu dropdown-messages">
								<li>
									<div class="dropdown-messages-box">
										<a href="profile.html" class="pull-left">
											<img alt="image" class="img-circle" src="http://placehold.it/40/30a5ff/fff">
										</a>
										<div class="message-body"><small class="pull-right">3 mins ago</small>
											<a href="#">
												<strong>John Doe</strong> commented on <strong>your photo</strong>.
											</a>
											<br /><small class="text-muted">1:24 pm - 25/03/2015</small>
										</div>
									</div>
								</li>
								<li class="divider"></li>
								<li>
									<div class="dropdown-messages-box">
										<a href="profile.html" class="pull-left">
											<img alt="image" class="img-circle" src="http://placehold.it/40/30a5ff/fff">
										</a>
										<div class="message-body"><small class="pull-right">1 hour ago</small>
											<a href="#">New message from <strong>Jane Doe</strong>.
											</a>
											<br /><small class="text-muted">12:27 pm - 25/03/2015</small>
										</div>
									</div>
								</li>
								<li class="divider"></li>
								<li>
									<div class="all-button">
										<a href="#">
											<em class="fa fa-inbox"></em> <strong>All Messages</strong>
										</a>
									</div>
								</li>
							</ul>
						</li>
						<li class="dropdown">
							<a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
								<em class="fa fa-bell"></em><span class="label label-info">5</span>
							</a>
							<ul class="dropdown-menu dropdown-alerts">
								<li>
									<a href="#">
										<div>
											<em class="fa fa-envelope"></em> 1 New Message
											<span class="pull-right text-muted small">3 mins ago</span>
										</div>
									</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="#">
										<div>
											<em class="fa fa-heart"></em> 12 New Likes
											<span class="pull-right text-muted small">4 mins ago</span>
										</div>
									</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="#">
										<div>
											<em class="fa fa-user"></em> 5 New Followers
											<span class="pull-right text-muted small">4 mins ago</span>
										</div>
									</a>
								</li>
							</ul>
						</li>
						<li class="dropdown">
							<a class="dropdown-toggle count-info" href="<?php echo $base; ?>logout"> 
								<p onMouseOver="this.style.color='#30a5ff'" onMouseOut="this.style.color='#FFF'" style="font-size: 15px; color: #FFF"><i class="fa fa-sign-out fa-fw"></i></p>
							</a>
						</li>
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
			<li class="active"><a href="../list_permintaan"><em class="fa fa-envelope-open">&nbsp;</em> List Permintaan APD</a></li>
			<li><a href="../list_pengadaan"><em class="fa fa-plus">&nbsp;</em> Pengadaan APD</a></li>
			<li><a href="../ganti_password"><em class="fa fa-plus">&nbsp;</em> Ganti Password</a></li>
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
				<div class="container col-lg-12">
					<div class="list-group">
						<div class="row">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<strong>
										Detail Permintaan
									</strong>
								</div>
								<div class="panel-body">
									<div class="col-lg-12">
										<form method="post" action="" enctype="multipart/form-data">
											<div class="form-group">
												<label>Nama Karyawan</label>
												<input class="form-control" type="text" name="id" disabled="" value="<?php echo $nama; ?>">
											</div>
											<div class="form-group">
												<label>Tanggal Pengajuan Permintaan</label>
												<input class="form-control" type="text" name="nama" disabled="" value="<?php echo $tanggal; ?>">
											</div>
										</form>

										<table class="table-read" border="2">
											<tr>
												<th>Jenis APD</th>
												<th>Jumlah</th>
											</tr>

											<?php

											$data = mysqli_query($conn, "SELECT stock.jumlah_stock,apd.id_apd,apd.nama_apd,permintaan.jumlah_permintaan,permintaan.status_permintaan FROM apd JOIN permintaan on permintaan.id_apd = apd.id_apd JOIN stock on stock.id_apd =  permintaan.id_apd WHERE permintaan.nip_karyawan = '$nip' && permintaan.tanggal_permintaan = '$tanggal'");

											while ($row = mysqli_fetch_array($data)) { ?>				
												<?php $stts = $row['status_permintaan']; ?>
												<?php $stock_update[] = $row['jumlah_stock'] - $row['jumlah_permintaan']; ?>
												<?php $id_apd[] = $row['id_apd']; ?>
												<tr>
													<form>
														<td class="td-read"><?php echo $row['nama_apd'].' - '.$row['id_apd']; ?></td>
														<td class="td-read"><?php echo $row['jumlah_permintaan']; ?></td>
													</form>
												</tr>
											<?php } ?>
										</table>
									</div>
									<?php if ($stts == 'Belum Disetujui') { ?>
									<form class="col-lg-6" method="POST" action="detail.php" style="text-align: left;">
										<input type="hidden" name="nip" value="<?php echo $nip ?>">
										<input type="hidden" name="tanggal" value="<?php echo $tanggal ?>">
										<a><button type="submit" name="tolak" style="margin: 7px;" class="btn btn-md btn-danger">Tolak</button></a>
									</form>
									<form class="col-lg-6" method="POST" action="detail.php" style="text-align: right;">
										<input type="hidden" name="nip" value="<?php echo $nip ?>">
										<input type="hidden" name="tanggal" value="<?php echo $tanggal ?>">
										<a><button type="submit" name="setujui" style="margin: 7px; width: 200px;" class="btn btn-md btn-success">Setujui</button></a>
									</form>
									<?php } else { ?>

									<?php } ?>
									

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" tabindex="-1" role="dialog" id="gagal">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title alert alert-danger">GAGAL!</h4>
					</div>
					<div class="modal-body">
						<p>Stok tidak mencukupi..</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
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

	<?php 

	if (isset($_POST['setujui'])) {

		for ($i=0; $i < count($stock_update); $i++) { 

			if ($stock_update[$i] < 0) {
				echo "<script type='text/javascript'>
				$(window).on('load',function(){
					$('#gagal').modal('show');
					});
					</script>";
			} else {
				mysqli_query($conn, "UPDATE stock SET jumlah_stock='$stock_update[$i]' WHERE id_apd='$id_apd[$i]'");
				mysqli_query($conn, "UPDATE permintaan SET status_permintaan='Disetujui', notif='Disetujui' WHERE nip_karyawan = '$nip' and tanggal_permintaan='$tanggal'");
				echo "<script>location.href='index.php';</script>";
			}	
		}
	} elseif (isset($_POST['tolak'])) {
		mysqli_query($conn, "UPDATE permintaan SET status_permintaan='Ditolak', notif='Ditolak' WHERE nip_karyawan = '$nip' and tanggal_permintaan='$tanggal'");
		echo "<script>location.href='index.php';</script>";
	}

	?>

</body>
</html>