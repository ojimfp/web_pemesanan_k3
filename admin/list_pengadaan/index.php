<?php
$base = "http://localhost/inventorymanagement/";

include '../../config.php';

session_start();

$tgl = date("d-m-Y");

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
			<li><a href="../list_pekerja"><em class="fa fa-users">&nbsp;</em> List Pekerja</a></li>
			<li><a href="../tambah_apd"><em class="fa fa-clone">&nbsp;</em> Tambah Jenis APD</a></li>
			<li><a href="../list_apd"><em class="fa fa-database">&nbsp;</em> List Data APD</a></li>
			<li><a href="../list_permintaan"><em class="fa fa-envelope-open">&nbsp;</em> List Permintaan APD</a></li>
			<li class="active"><a href="../list_pengadaan"><em class="fa fa-plus">&nbsp;</em> Pengadaan APD</a></li>
			<li><a href="../ganti_password"><em class="fa fa-plus">&nbsp;</em> Ganti Password</a></li>
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
				<li class="active">Pengadaan</li>
			</ol>
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header"></h1>
			</div>
		</div><!--/.row-->
	</div><!--/.row-->

	<div class="container col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
    <div class="list-group">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <strong>
              Pengadaan APD
            </strong>
          </div>
          <div class="panel-body">
            <div class="row">
              <form action="index.php" method="POST">
                  <table style="margin: 0 auto;" border="0">
                    <?php 
                    $read_data = mysqli_query($conn, "SELECT * FROM apd") or die(mysqli_error()); ?>
                    <tr>
                    <?php 
                    $i = 0;
                    while ($data = mysqli_fetch_array($read_data)) { ?>
                      <td style="text-align: center; vertical-align: middle;">
                        <div>
                          <img style="width: 140px; margin: 70px 50px 10px;" src="<?php echo $base.'assets/img/'.$data['gambar_apd']; ?>">
                          <strong><p style="text-align: center;"><?php echo $data['nama_apd'].' - '. $data['id_apd']; ?></p></strong>
                          <input class="form-control" type="number" name="jumlah[]" placeholder="jumlah pengadaan" id="<?php echo $data['id_apd'].'num'; ?>" min="1" style="display:none">
                          <input class="form-control" type="checkbox" name="id_apd[]" value="<?php echo $data['id_apd']; ?>" id="<?php echo $data['id_apd'].'id'; ?>" onclick="<?php echo $data['id_apd'].'()'; ?>">
                        </div> 
                        <script> 
                          function <?php echo $data['id_apd'].'()'; ?> {

                            var checkBox = document.getElementById("<?php echo $data['id_apd'].'id'; ?>");
                            var input = document.getElementById("<?php echo $data['id_apd'].'num'; ?>");

                            if (checkBox.checked == true){
                              input.style.display = "block";
                            } else {
                              input.value = "";
                              input.style.display = "none";
                            }
                          }

                        </script>

                        <?php 
                        $i++;
                        if ($i%4 == 0) {
                          echo '</td></tr></div><div class="row">';
                        }
                      } ?>
                    </table>
                <div style="text-align: center; vertical-align: middle; margin: 40px auto 30px;">
                	<input class="btn btn-md btn-primary" type="submit" name="submit" value="Simpan Pengadaan">
                </div>
              	</form>
            </div>
          </div>
        </div>
      </div>
  	</div>

  	<div class="modal fade" tabindex="-1" role="dialog" id="success">
  		<div class="modal-dialog" role="document">
  			<div class="modal-content">
  				<div class="modal-header">
  					<h4 class="modal-title alert alert-success">BERHASIL!</h4>
  				</div>
  				<div class="modal-body">
  					<p>Pengadaan APD telah tersimpan..</p>
  				</div>
  				<div class="modal-footer">
  					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  				</div>
  			</div><!-- /.modal-content -->
  		</div><!-- /.modal-dialog -->
  	</div><!-- /.modal -->

  	<div class="modal fade" tabindex="-1" role="dialog" id="failed">
  		<div class="modal-dialog" role="document">
  			<div class="modal-content">
  				<div class="modal-header">
  					<h4 class="modal-title alert alert-success">GAGAL!</h4>
  				</div>
  				<div class="modal-body">
  					<p>Pengadaan APD gagal disimpan, periksa dan ulangi lagi..</p>
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
if (isset($_POST['submit'])) {
	if(!empty($_POST['jumlah'])) {
		foreach ($_POST['jumlah'] as $key => $value2) {
			if ($value2 !== "") {
				$jumlah[] = $value2;
			}
		}
	}

	if(!empty($_POST['id_apd'])) {
		foreach ($_POST['id_apd'] as $key1 => $value3) {
			$id[] = $value3;
		}
	}

	if (isset($jumlah)) {
		$j = count($jumlah);
	} else {
		$j = 0;
	}

	if (isset($id)) {
		$i = count($id);
	} else {
		$i = 0;
	}

	$sum_jml = array_sum($jumlah);
	
	$insert_pengadaan = mysqli_query($conn, "INSERT INTO pengadaan(jumlah_pengadaan, tanggal_pengadaan) VALUES ('$sum_jml','$tgl')") or die(mysqli_error());

	if ($insert_pengadaan) {
		$qry_id_pengadaan = mysqli_query($conn, "SELECT id_pengadaan FROM pengadaan ORDER BY id_pengadaan DESC LIMIT 1") or die(mysqli_error());
		$id_pengadaan = mysqli_fetch_array($qry_id_pengadaan);
		$id_p = $id_pengadaan['id_pengadaan'];

		$idmin1 = $id_p - 1;

		$qry_total_stock = mysqli_query($conn, "SELECT id_apd,total_stock FROM stock WHERE id_pengadaan = '$idmin1'") or die(mysqli_error());
			while($row = mysqli_fetch_array($qry_total_stock)){
				$apd_id[] = $row['id_apd'];
				$total_stock[] = $row['total_stock'];
			}

			$merge_id = array_merge($apd_id, $id);
			$merge_jml = array_merge($total_stock, $jumlah);

		if ($j == $i && $i > 0 && $j > 0) {
			for ($a=0; $a < count($merge_id); $a++) { 
				$jumlah_pengadaan = $merge_jml[$a];
				$id_apd = $merge_id[$a];
				
			mysqli_query($conn, "INSERT INTO stock(id_apd,jumlah_stock,total_stock,id_pengadaan) VALUES ('$id_apd', '$jumlah_pengadaan', '$jumlah_pengadaan', '$id_p')") or die(mysqli_error());
			}
			echo "<script type='text/javascript'>
			$(window).on('load',function(){
				$('#success').modal('show');
				});
				</script>";
		} else {
			echo "<script type='text/javascript'>
			$(window).on('load',function(){
				$('#failed').modal('show');
				});
				</script>";
		}
	}	
}
?>

</body>
</html>