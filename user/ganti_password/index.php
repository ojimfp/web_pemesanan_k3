<!DOCTYPE html>

<?php
$base = "http://localhost/inventorymanagement/";
include '../../config.php';
// mengaktifkan session
session_start();

// cek apakah user telah login, jika belum login maka di alihkan ke halaman login

$nip = $_SESSION['nip'];
$hak_akses = $_SESSION['hak_akses'];
$nama_karyawan = $_SESSION['nama_karyawan'];

if($_SESSION['status'] !="login".$nip.""){
  header("location:". $base."login");
}

?>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User - Dashboard</title>
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
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="../user"><span>PG Kebon Agung</span></a>
        <ul class="nav navbar-top-links navbar-right">
          <li >
            <a class="navbar-brand" href="<?php echo $base; ?>logout">
              <p onMouseOver="this.style.color='#30a5ff'" onMouseOut="this.style.color='#FFF'" style="font-size: 15px; color: #FFF"><i class="fa fa-sign-out fa-fw"></i> Logout</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="col-lg-12">
    <div class="row">
      <ol class="breadcrumb">
        <li><a href="../user">
          <em class="fa fa-home"></em>
        </a></li>
        <li><a href="../index.php">Permintaan APD</a></li>
        <li><a href="#">Peminjaman APD</a></li>
        <li><a href="#"></a>Ganti Password</li>
        <p style="float: right;">Welcome <?php echo $nama_karyawan; ?></p>
      </ol>
    </div><!--/.row-->

    <div class="row">
      <div class="col-lg-12">
        <h1 style="text-align: center;" class="page-header"></h1>
      </div>
    </div>
  </div>


  <div class="container col-lg-6 col-md-offset-3">
    <div class="list-group">
      <form method="POST" action="ganti.php">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <strong>
              Ganti Password
            </strong>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label>Password Lama</label>
                  <input class="form-control" type="password" name="pass_lama" required="">
                </div>
                <div class="form-group">
                  <label>Password Baru</label>
                  <input class="form-control" type="password" name="pass_baru" required="">
                </div>
                <div class="form-group">
                  <label>Konfirmasi Password Baru</label>
                  <input class="form-control" type="password" name="konf_pass_baru" required="">
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
        </div>
      </form>
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
