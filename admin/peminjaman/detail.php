<?php
$base = "http://localhost/inventorymanagement/";

include '../../config.php';

session_start();

$nip = $_POST['nip'];
$tgl_pinjam = $_POST['tgl_pinjam'];
$tgl_kembali = $_POST['tgl_kembali'];
$status_peminjaman = $_POST['status_peminjaman'];
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
			<li class="active">
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
				<li class="active">Peminjaman Alat Pelindung Diri</li>
			</ol>
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Peminjaman APD</h1>
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
										Detail Peminjaman
									</strong>
								</div>
								<div class="panel-body">
									<div class="col-lg-12">
										<form method="post" action="" enctype="multipart/form-data">
											<div class="form-group">
												<label>Nama Karyawan</label>
												<input class="form-control" type="text" name="nama" disabled="" value="<?php echo $nama; ?>">
											</div>
											<div class="form-group">
												<label>Tanggal Peminjaman</label>
												<input class="form-control" type="text" name="tgl_pinjam" disabled="" value="<?php echo $tgl_pinjam; ?>">
											</div>
											<div class="form-group">
												<label>Tanggal Pengembalian</label>
												<input class="form-control" type="text" name="tgl_kembali" disabled="" value="<?php echo $tgl_kembali; ?>">
											</div>

											<?php if ($status_peminjaman == 'Belum Dikembalikan') { ?>
												<div class="form-group">
													<label>Tanggal Aktual Pengembalian</label>
													<?php 
													$newDate = date('Y-m-d', strtotime($tgl_kembali));
													?>
													<input class="form-control" type="date" name="tgl_aktual_kembali" value="<?php echo $newDate; ?>" placeholder="">
												</div>
											<?php } ?>

										</form>

										<table class="table-read" border="2">
											<tr>
												<th>Jenis APD</th>
												<th>Jumlah</th>
											</tr>

											<?php

											$data = mysqli_query($conn, "SELECT peminjaman.id_apd, peminjaman.jumlah, apd.nama_apd FROM peminjaman JOIN apd on peminjaman.id_apd = apd.id_apd WHERE peminjaman.nip_karyawan = '$nip' && peminjaman.tgl_pinjam = '$tgl_pinjam' && peminjaman.tgl_kembali = '$tgl_kembali' && peminjaman.status_peminjaman = '$status_peminjaman'");

											while ($row = mysqli_fetch_array($data)) { ?>				
												<tr>
													<form>
														<td class="td-read"><?php echo $row['nama_apd'].' - '.$row['id_apd']; ?></td>
														<td class="td-read"><?php echo $row['jumlah']; ?></td>
													</form>
												</tr>
											<?php } ?>
										</table>
									</div>
									<?php if ($status_peminjaman == 'Belum Disetujui') { ?>
									<form class="col-lg-6" method="POST" action="detail.php" style="text-align: left;">
										<input type="hidden" name="nip" value="<?php echo $nip; ?>">
										<input type="hidden" name="tgl_pinjam" value="<?php echo $tgl_pinjam; ?>">
										<input type="hidden" name="tgl_kembali" value="<?php echo $tgl_kembali; ?>">
										<input type="hidden" name="status_peminjaman" value="<?php echo $status_peminjaman; ?>">
										<input type="hidden" name="nama" value="<?php echo $nama; ?>">
										<a><button type="submit" name="tolak" style="margin: 7px;" class="btn btn-md btn-danger">Tolak</button></a>
									</form>
									<form class="col-lg-6" method="POST" action="detail.php" style="text-align: right;">
										<input type="hidden" name="nip" value="<?php echo $nip; ?>">
										<input type="hidden" name="tgl_pinjam" value="<?php echo $tgl_pinjam; ?>">
										<input type="hidden" name="tgl_kembali" value="<?php echo $tgl_kembali; ?>">
										<input type="hidden" name="status_peminjaman" value="<?php echo $status_peminjaman; ?>">
										<input type="hidden" name="nama" value="<?php echo $nama; ?>">
										<a><button type="submit" name="setujui" style="margin: 7px; width: 200px;" class="btn btn-md btn-success">Setujui</button></a>
									</form>
									<?php } elseif ($status_peminjaman == 'Belum Dikembalikan') { ?>
										<form class="col-lg-12" method="POST" action="detail.php" style="text-align: right;">
											<input type="hidden" name="nip" value="<?php echo $nip; ?>">
											<input type="hidden" name="tgl_pinjam" value="<?php echo $tgl_pinjam; ?>">
											<input type="hidden" name="tgl_kembali" value="<?php echo $tgl_kembali; ?>">
											<input type="hidden" name="status_peminjaman" value="<?php echo $status_peminjaman; ?>">
											<input type="hidden" name="nama" value="<?php echo $nama; ?>">
											<a><button type="submit" name="dikembalikan" style="margin: 7px; width: 200px;" class="btn btn-md btn-primary">Dikembalikan</button></a>
										</form>
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
		mysqli_query($conn, "UPDATE peminjaman SET status_peminjaman='Belum Dikembalikan', notif='Belum Dikembalikan' WHERE nip_karyawan='$nip' && tgl_pinjam='$tgl_pinjam' && tgl_kembali='$tgl_kembali' && status_peminjaman='$status_peminjaman'") or die(mysqli_error());
		echo "<script>location.href='index.php';</script>";
		
	} elseif (isset($_POST['tolak'])) {
		mysqli_query($conn, "UPDATE peminjaman SET status_peminjaman='Ditolak', notif='Ditolak' WHERE nip_karyawan='$nip' && tgl_pinjam='$tgl_pinjam' && tgl_kembali='$tgl_kembali' && status_peminjaman='$status_peminjaman'") or die(mysqli_error());
		echo "<script>location.href='index.php';</script>";

	} elseif (isset($_POST['dikembalikan'])) {
		$t_act_kmbl = date('d-m-Y', strtotime($_POST['tgl_aktual_kembali']));
		mysqli_query($conn, "UPDATE peminjaman SET tgl_aktual_kembali='$t_act_kmbl', status_peminjaman='Sudah Dikembalikan', notif='Sudah Dikembalikan' WHERE nip_karyawan='$nip' && tgl_pinjam='$tgl_pinjam' && tgl_kembali='$tgl_kembali' && status_peminjaman='$status_peminjaman'") or die(mysqli_error());
		echo "<script>location.href='index.php';</script>";
	}

	?>

</body>
</html>