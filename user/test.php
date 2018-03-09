<!DOCTYPE html>

<?php 
$base = "http://localhost/inventorymanagement/";
include '../config.php';
// mengaktifkan session
session_start();

// cek apakah user telah login, jika belum login maka di alihkan ke halaman login

$username = $_SESSION['username'];

if($_SESSION['status'] !="login".$username.""){
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
        <a class="navbar-brand" href="#"><span>PG Kebon Agung</span></a>
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
        <li><a href="#">
          <em class="fa fa-home"></em>
        </a></li>
        <li class="active">Permintaan APD</li>
        <li style="float: right;">Welcome <?php  ?></li>
      </ol>
    </div><!--/.row-->

    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Dashboard</h1>
      </div>
    </div><!--/.row-->

    <div class="panel panel-container">
      <div class="row">
        <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
          <div class="panel panel-teal panel-widget border-right">
            <div class="row no-padding"><em class="fa fa-xl fa-shopping-cart color-blue"></em>
              <div class="large">120</div>
              <div class="text-muted">New Orders</div>
            </div>
          </div>
        </div>
        <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
          <div class="panel panel-blue panel-widget border-right">
            <div class="row no-padding"><em class="fa fa-xl fa-comments color-orange"></em>
              <div class="large">52</div>
              <div class="text-muted">Comments</div>
            </div>
          </div>
        </div>
        <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
          <div class="panel panel-orange panel-widget border-right">
            <div class="row no-padding"><em class="fa fa-xl fa-users color-teal"></em>
              <div class="large">24</div>
              <div class="text-muted">New Users</div>
            </div>
          </div>
        </div>
        <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
          <div class="panel panel-red panel-widget ">
            <div class="row no-padding"><em class="fa fa-xl fa-search color-red"></em>
              <div class="large">25.2k</div>
              <div class="text-muted">Page Views</div>
            </div>
          </div>
        </div>
      </div><!--/.row-->
    </div>
  </div>  <!--/.main-->

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