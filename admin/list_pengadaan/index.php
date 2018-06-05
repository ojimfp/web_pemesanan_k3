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
			<li class="active"><a href="../list_pengadaan"><em class="fa fa-plus">&nbsp;</em> Pengadaan APD</a></li>
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
                        <div style="margin-bottom: 40px;">
                          <img style="width: 100px; margin: 10px 50px 10px;" src="<?php echo $base.'assets/img/'.$data['gambar_apd']; ?>">
                          <strong><p style="text-align: center;"><?php echo $data['nama_apd'].' - '. $data['id_apd']; ?></p></strong>
                          <input class="form-control" type="number" name="jumlah[]" placeholder="jumlah pengadaan" id="<?php echo $data['id_apd'].'num'; ?>" min="1" onkeypress="return isNumberKey(event)" style="display:none">
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
                        if ($i%5 == 0) {
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
  					<h4 class="modal-title alert alert-danger">GAGAL!</h4>
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

		if ($j == $i && $i > 0 && $j > 0) {
			$sum_jml = array_sum($jumlah);
			// ini memasukkan ke tabel pengadaan
			$insert_pengadaan = mysqli_query($conn, "INSERT INTO pengadaan(jumlah_pengadaan, tanggal_pengadaan) VALUES ('$sum_jml','$tgl')") or die(mysqli_error());

			if ($insert_pengadaan) {
				// mengambil id pengadaan dari pengadaan yang baru dimasukkan
				$qry_id_pengadaan = mysqli_query($conn, "SELECT id_pengadaan FROM pengadaan ORDER BY id_pengadaan DESC LIMIT 1") or die(mysqli_error());
				$id_pengadaan = mysqli_fetch_array($qry_id_pengadaan);
				$id_p = $id_pengadaan['id_pengadaan'];

				//ini untuk mengambil id apd dan jumlah stock dari pengadaan sebelumnya
				if ($id_p == 1) {

					echo "masuk p1";
					$data_id_apd = mysqli_query($conn, "SELECT id_apd FROM apd") or die(mysqli_error());
					while($row = mysqli_fetch_array($data_id_apd)){
						$data_apd_id[] = $row['id_apd'];
					}

						// apd yang disimpan di database
						for ($r=0; $r < count($data_apd_id); $r++) { 
							$data_apd = $data_apd_id[$r];

							mysqli_query($conn, "INSERT INTO stock(id_apd,jumlah_stock,id_pengadaan) VALUES ('$data_apd',0,1)") or die(mysqli_error());


							// data yang diinputkan
							for ($a=0; $a < $j; $a++) { 
								$jumlah_pengadaan = $jumlah[$a];
								$idapd = $id[$a];

								if ($idapd == $data_apd) {
									$tot = $jumlah_pengadaan;

								// // ini untuk memasukkan data yang diadakan
									mysqli_query($conn, "UPDATE stock SET jumlah_stock='$tot' WHERE id_apd='$idapd' AND id_pengadaan =1") or die(mysqli_error());
								} //end if

							}
						}
					echo "<script type='text/javascript'>
						$(window).on('load',function(){
						$('#success').modal('show');
						});
						</script>";
				} else {
					echo "masuk p > 1";
					$idmin1 = $id_p - 1;

					// ini untuk ambil data dengan id sebelumnya, yang mau dimasukin ke tabel stock 
					$qry_jumlah_stock = mysqli_query($conn, "SELECT id_apd,jumlah_stock FROM stock WHERE id_pengadaan = '$idmin1'") or die(mysqli_error());
					while($row = mysqli_fetch_array($qry_jumlah_stock)){
						$apd_id[] = $row['id_apd'];
						$jumlah_stock[] = $row['jumlah_stock'];
					}

					$c_apd_id = count($apd_id);
					$c_jumlah_stock = count($jumlah_stock);

					for ($l=0; $l < $c_apd_id; $l++) {
						$id_data_lama = $apd_id[$l];
						$jumlah_stock_lama = $jumlah_stock[$l];

						// ini untuk memasukkan data lama ke database
						mysqli_query($conn, "INSERT INTO stock(id_apd,jumlah_stock,id_pengadaan) VALUES ('$id_data_lama','$jumlah_stock_lama','$id_p')") or die(mysqli_error());

						// data yang diinput
						for ($a=0; $a < $j; $a++) {
							$jml_pengadaan = $jumlah[$a];
							$id_apd = $id[$a];

							if ($id_apd == $id_data_lama) {
								$tot = $jumlah_stock_lama + $jml_pengadaan;
								echo "Id nya sama";

								// ini untuk memasukkan data yang diadakan
								mysqli_query($conn, "UPDATE stock SET jumlah_stock='$tot' WHERE id_apd='$id_apd' AND id_pengadaan = '$id_p'") or die(mysqli_error());
							} //end if
						}
					}

				echo "<script type='text/javascript'>
				$(window).on('load',function(){
					$('#success').modal('show');
					});
					</script>";

				}
			} else {
				echo "<script type='text/javascript'>
				$(window).on('load',function(){
					$('#failed').modal('show');
					});
					</script>";
			}
		} else {
			echo "<script type='text/javascript'>
				$(window).on('load',function(){
					$('#failed').modal('show');
					});
					</script>";
		}
}
?>
<script type="text/javascript">
	function isNumberKey(evt){
		var charCode = (evt.which) ? evt.which : event.keyCode
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		return true;
	}
</script>

</body>
</html>