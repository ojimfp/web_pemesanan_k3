<?php
$base = "http://localhost/inventorymanagement/";

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
					<a class="navbar-brand" href="<?php echo $base; ?>admin"><span>PG Kebon Agung</span></a>
					<ul class="nav navbar-top-links navbar-right">
					</ul>
				</div>
			</div><!-- /.container-fluid -->
		</nav>

		<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
			<ul class="nav menu">
				<li><a href="../../admin"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
				<li class="active"><a href="../tambah_pekerja"><em class="fa fa-user-plus">&nbsp;</em> Tambah Pekerja</a></li>
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
					<li class="active">Tambah Pekerja</li>
				</ol>
			</div>

			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header"></h1>
				</div>
			</div>

			<div class="container col-lg-12">
				<div class="list-group">
					<form method="POST" action="index.php">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<strong>
									Tambah Pekerja
								</strong>
							</div>
							<div class="panel-body">
								<div class="col-lg-12">
									<div class="form-group">
										<label>Nama Pekerja</label>
										<input class="form-control" type="text" name="nama" required="" autofocus="">
									</div>
									<div class="form-group">
										<label>Jenis Kelamin</label>
										<select name="jenis_kelamin" class="form-control" required="">
											<option>Laki-laki</option>
											<option>Perempuan</option>
										</select>
									</div>
									<div class="form-group">
										<label>Tanggal Lahir</label>
										<input class="form-control" type="date" name="tgllahir" required="">
									</div>
									<div class="form-group">
										<label>Alamat</label>
										<input class="form-control" type="text" name="alamat" required="">
									</div>
									<div class="form-group">
										<label>E-mail</label>
										<input class="form-control" type="email" name="email" required="">
									</div>
									<div class="form-group">
										<label>Jabatan</label>
										<select name="jabatan" class="form-control" required="">
											<option>Karyawan Umum</option>
											<option>Karyawan Pabrik</option>
										</select>
									</div>
									<br>
									<br>
									<div class="button-submit">
										<input style="width: 100%; " class="btn btn-sm btn-primary" type="submit" name="submit" value="SUBMIT">
									</div>
									<br>
									<br>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>

			<div class="modal fade" tabindex="-1" role="dialog" id="failed">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title alert alert-danger">GAGAL!</h4>
						</div>
						<div class="modal-body">
							<p>Data karyawan gagal ditambahkan, silakan ulangi lagi..</p>
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

<?php

if (isset($_POST['submit'])) {
$nama = $_POST['nama'];
$jeniskelamin = substr($_POST['jenis_kelamin'], 0, 1);
$tgllahir = date("d-m-Y", strtotime($_POST['tgllahir']));
$alamat = $_POST['alamat'];
$email = $_POST['email'];
$jabatan = substr($_POST['jabatan'], 0, 8);

$j = $_POST['jabatan'];

if ($j == "Karyawan Umum") {

	$read_nip = mysqli_query($conn, "SELECT MAX(nip) FROM karyawan WHERE SUBSTRING(nip, 1, 2) = 51 ");

	while ($data = mysqli_fetch_array($read_nip)) {

		$nip_password = $data['MAX(nip)'] + 1;

		if (mysqli_query($conn, "INSERT INTO karyawan (nip, password, nama_karyawan, jenis_kelamin, tgl_lahir, alamat, email, jabatan)
			VALUES ('$nip_password', '$nip_password' ,'$nama', '$jeniskelamin', '$tgllahir', '$alamat', '$email', '$jabatan')")) 
		{
			// echo "
			// <script>alert('Data berhasil ditambahkan.. \\n\\nNIP : $nip_password \\nPassword : $nip_password')
			// </script>";
			// echo "<script>location.href='../tambah_pekerja';</script>";

			echo "<script type='text/javascript'>
			$(window).on('load',function(){
				$('#success').modal('show');
				});
				</script>";

		} else {
			// echo "<script>alert('Data gagal ditambah..')</script>";
			// echo "<script>location.href='../tambah_pekerja';</script>";
			echo "<script type='text/javascript'>
			$(window).on('load',function(){
				$('#failed').modal('show');
				});
				</script>";
		}

	}

	
} elseif($j == "Karyawan Pabrik"){

	$read_nip2 = mysqli_query($conn, "SELECT MAX(nip) FROM karyawan WHERE SUBSTRING(nip, 1, 2) = 52 ");

	while ($data = mysqli_fetch_array($read_nip2)) {

		$nip_password = $data['MAX(nip)'] + 1;

		if (mysqli_query($conn, "INSERT INTO karyawan (nip, password, nama_karyawan, jenis_kelamin, tgl_lahir, alamat, email, jabatan)
			VALUES ('$nip_password', '$nip_password' ,'$nama', '$jeniskelamin', '$tgllahir', '$alamat', '$email', '$jabatan')")) 
		{
			// echo "
			// <script>alert('Data berhasil ditambahkan.. \\n\\nNIP : $nip_password \\nPassword : $nip_password')
			// </script>";
			// echo "<script>location.href='../tambah_pekerja';</script>";

			echo "<script type='text/javascript'>
			$(window).on('load',function(){
				$('#success').modal('show');
				});
				</script>";
		} else {
			// echo "<script>alert('Data gagal ditambah..')</script>";
			// echo "<script>location.href='../tambah_pekerja';</script>";

			echo "<script type='text/javascript'>
			$(window).on('load',function(){
				$('#failed').modal('show');
				});
				</script>";
		}

	}

}
}

?>

<div class="modal fade" tabindex="-1" role="dialog" id="success">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title alert alert-success">BERHASIL!</h4>
			</div>
			<div class="modal-body">
				<p>Data karyawan berhasil disimpan..</p>
				<p>Kode User : <?php echo $nip_password; ?></p>
				<p>Password : <?php echo $nip_password; ?></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

</body>
</html>
