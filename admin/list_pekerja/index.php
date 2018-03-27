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
		<!-- <div class="profile-sidebar">
			<div class="profile-userpic">
				<img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">
			</div>
			<div class="profile-usertitle">
				<div class="profile-usertitle-name">Username</div>
				<div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="divider"></div> -->
		<!-- <form role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Search">
			</div>
		</form> -->
		<ul class="nav menu">
			<li><a href="../../admin"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
			<li><a href="../tambah_pekerja"><em class="fa fa-user-plus">&nbsp;</em> Tambah Pekerja</a></li>
			<li class="active"><a href="../list_pekerja"><em class="fa fa-users">&nbsp;</em> List Pekerja</a></li>
			<li><a href="../tambah_apd"><em class="fa fa-clone">&nbsp;</em> Tambah Data APD</a></li>
			<li><a href="../list_apd"><em class="fa fa-database">&nbsp;</em> List Data APD</a></li>
			<li><a href="../list_permintaan"><em class="fa fa-envelope-open">&nbsp;</em> List Permintaan APD</a></li>
			<li><a href="../list_pengadaan"><em class="fa fa-plus">&nbsp;</em> Pengadaan APD</a></li>
			<!-- <li class="parent "><a data-toggle="collapse" href="#sub-item-1">
				<em class="fa fa-navicon">&nbsp;</em> Multilevel <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span></a>
				<ul class="children collapse" id="sub-item-1">
					<li><a class="" href="#">
						<span class="fa fa-arrow-right">&nbsp;</span> Sub Item 1
					</a></li>
					<li><a class="" href="#">
						<span class="fa fa-arrow-right">&nbsp;</span> Sub Item 2
					</a></li>
					<li><a class="" href="#">
						<span class="fa fa-arrow-right">&nbsp;</span> Sub Item 3
					</a></li>
				</ul>
			</li> -->
			<!-- <li><a href="login.html"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li> -->
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
				<h1 class="page-header">List Pekerja</h1>
			</div>
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<table class="table-read" border="2">
					<tr>
						<th>NIK</th>
						<th>Nama</th>
						<th>Jenis Kelamin</th>
						<th>Tanggal Lahir</th>
						<th>Alamat</th>
						<th>E-mail</th>
						<th>Jabatan</th>
						<th>Opsi</th>
					</tr>
					<?php
					$read_data = mysqli_query($conn, "SELECT nik, nama_karyawan, jabatan, email, jenis_kelamin, tgl_lahir, alamat FROM karyawan") or die(mysqli_error());
					while ($data = mysqli_fetch_array($read_data)) {
					?>
					<tr>
						<td class="td-read"><?php echo $data['nik']; ?></td>
						<td class="td-read"><?php echo $data['nama_karyawan']; ?></td>
						<td class="td-read"><?php echo $data['jenis_kelamin']; ?></td>
						<td class="td-read"><?php echo $data['tgl_lahir']; ?></td>
						<td class="td-read"><?php echo $data['alamat']; ?></td>
						<td class="td-read"><?php echo $data['email']; ?></td>
						<td class="td-read"><?php echo $data['jabatan']; ?></td>
						<td>
							<button style="margin: 7px;" class="btn btn-sm btn-primary">Edit</button>
							<button style="margin: 7px;" class="btn btn-sm btn-danger">Hapus</button>
						</td>
					</tr>
					<?php } ?>
				</table>
			</div>
		</div>
	</div><!--/.row-->

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
