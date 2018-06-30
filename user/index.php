<!DOCTYPE html>

<?php
$base = "http://localhost/inventorymanagement/";
include '../config.php';
// mengaktifkan session
session_start();

// cek apakah user telah login, jika belum login maka di alihkan ke halaman login

$nip = $_SESSION['nip'];
$hak_akses = $_SESSION['hak_akses'];
$nama_karyawan = $_SESSION['nama_karyawan'];
$tgl = date("d-m-Y");

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
        <a class="navbar-brand" href="../user"><span>Perusahaan Gula</span></a>
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
        <li><a href="#"></a>Permintaan APD</li>
        <li><a href="peminjaman.php">Peminjaman APD</a></li>
        <li><a href="ganti_password/index.php">Ganti Password</a></li>
        <p style="float: right;">Welcome <?php echo $nama_karyawan; ?></p>
      </ol>
    </div><!--/.row-->

    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header"></h1>
      </div>
    </div>
  </div>

  <div class="container col-lg-7">
    <div class="list-group">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <strong>
              Permintaan APD
            </strong>
          </div>
          <div class="panel-body">
            <div class="row">
              <form action="index.php" method="POST">
                <?php if ($hak_akses == "pabrik") { ?>
                  <table style="margin: 0 auto;" border="0">
                    <?php 
                    $read_data = mysqli_query($conn, "SELECT * FROM apd") or die(mysqli_error()); ?>
                    <tr>
                    <?php 
                    $i = 0;
                    while ($data = mysqli_fetch_array($read_data)) { ?>
                      <td style="text-align: center; vertical-align: middle;">
                        <div style="margin: 5px">
                          <img style="width: 90px; margin: 20px 40px 10px;" src="<?php echo $base.'assets/img/'.$data['gambar_apd']; ?>">
                          <strong><p style="text-align: center;"><?php echo $data['nama_apd'].' - '. $data['id_apd']; ?></p></strong>
                          <input class="form-control" type="checkbox" name="id_apd[]" value="<?php echo $data['id_apd']; ?>" id="<?php echo $data['id_apd'].'id'; ?>" onclick="<?php echo $data['id_apd'].'()'; ?>">
                          <input class="form-control" type="number" name="jumlah[]" placeholder="jumlah permintaan" id="<?php echo $data['id_apd'].'num'; ?>" min="1" style="display:none">
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
                  <?php } elseif($hak_akses == "umum") { ?>
                    <table style="margin: 0 auto;" border="0">
                      <?php 
                    $read_data = mysqli_query($conn, "SELECT * FROM `apd` WHERE apd.id_apd = 'S41' or apd.id_apd = 'S42' or apd.id_apd = 'S43' or apd.id_apd = 'S44' or apd.id_apd = 'H001' ") or die(mysqli_error()); ?>
                    <tr>
                    <?php 
                    $i = 0;
                    while ($data = mysqli_fetch_array($read_data)) { ?>
                      <td style="text-align: center; vertical-align: middle;">
                        <div>
                          <img style="width: 140px; margin: 70px 50px 10px;" src="<?php echo $base.'assets/img/'.$data['gambar_apd']; ?>">
                          <strong><p style="text-align: center;"><?php echo $data['nama_apd'].' - '. $data['id_apd']; ?></p></strong>
                          <input class="form-control" type="checkbox" name="id_apd[]" value="<?php echo $data['id_apd']; ?>" id="<?php echo $data['id_apd'].'id'; ?>" onclick="<?php echo $data['id_apd'].'()'; ?>">
                          <input class="form-control" type="number" name="jumlah[]" placeholder="jumlah permintaan" id="<?php echo $data['id_apd'].'num'; ?>" min="1" style="display:none">
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
                        if ($i%3 == 0) {
                          echo '</td></tr></div><div class="row">';
                        }
                      } ?>
                    </table>
                  <?php } ?>
                <div style="text-align: center; vertical-align: middle; margin: 40px auto 30px;">

                  <?php 
                  $status_belum_disetujui = mysqli_query($conn, "SELECT status_permintaan FROM permintaan WHERE nip_karyawan='$nip' and status_permintaan='Belum Disetujui'") or die(mysqli_error()); 
                  $notif = mysqli_query($conn, "SELECT notif FROM permintaan WHERE nip_karyawan='$nip' ORDER BY tanggal_permintaan DESC LIMIT 1") or die(mysqli_error()); 
                  $bs = mysqli_fetch_array($status_belum_disetujui);
                  $t = mysqli_fetch_array($notif);

                  if ($bs['status_permintaan'] == 'Belum Disetujui') { ?>
                    <input class="btn btn-md btn-primary" type="button" data-toggle="modal" data-target="#waiting" value="Ajukan Permintaan">
                  <?php } else {?>
                    <input class="btn btn-md btn-primary" type="submit" name="submit" value="Ajukan Permintaan">
                  <?php } ?>
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>
  </div>

  <div class="container col-lg-5">
    <div class="list-group">
      <form method="POST" action="ganti.php">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <strong>
              SOP Permintaan APD
            </strong>
          </div>
          <div class="panel-body">
            <div class="row" style="margin: 10px; ">
             <p>Bagi pekerja PG. Kebon Agung apabila APD yang telah diberikan oleh perusahaan rusak akibat proses produksi, maka pekerja dapat meminta APD baru dengan prosedur sebagai berikut : </p>

                <p>1. Pekerja PG. Kebon Agung hanya diperbolehkan meminta APD yang sesuai dengan ketentuan yang telah ditetapkan perusahaan.</p><br>
                <p>2. Pekerja wajib membawa bukti bahwa APD yang digunakan benar benar rusak dan tidak dapat digunakan sehingga membutuhkan pergantian.</p><br> 
                <p>3. Dalam melakukan permintaan APD pekerja wajib mengisi formulir permintaan pada website management inventory.</p><br>
                <p>4. Setelah mengisi formulir permintaan pekerja datang ke bagian gudang untuk meminta APD yang telah diisi pada form permintaan.</p>

            </div>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="modal fade" tabindex="-1" role="dialog" id="success">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title alert alert-success">BERHASIL!</h4>
        </div>
        <div class="modal-body">
          <p>Permintaan APD telah dikirim..</p>
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
          <p>Permintaan APD gagal dikirim, periksa kembali permintaan anda..</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

  <div class="modal fade" tabindex="-1" role="dialog" id="waiting">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title alert alert-info">INFORMASI!</h4>
        </div>
        <div class="modal-body">
          <p>Permintaan anda sebelumnya belum disetujui, silakan menunggu sampai admin melakukan persetujuan..</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

  <div class="modal fade" tabindex="-1" role="dialog" id="ditolak">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title alert alert-danger">INFORMASI!</h4>
        </div>
        <div class="modal-body">
          <p>Permintaan anda sebelumnya ditolak..</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

  <div class="modal fade" tabindex="-1" role="dialog" id="disetujui">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title alert alert-success">INFORMASI!</h4>
        </div>
        <div class="modal-body">
          <p>Permintaan anda sebelumnya telah disetujui</p>
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
    // echo $value2."<br>";
      if ($value2 !== "") {
        $jumlah[] = $value2;
      }
    }
  }

  if(!empty($_POST['id_apd'])) {
    foreach ($_POST['id_apd'] as $key1 => $value3) {
    // echo $value3."<br>";
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
    for ($a=0; $a < $j; $a++) { 
      $jumlah_permintaan = $jumlah[$a];
      $id_apd = $id[$a];

      mysqli_query($conn, "INSERT INTO permintaan(id_permintaan, id_apd, nip_karyawan, tanggal_permintaan, jumlah_permintaan, status_permintaan, notif) VALUES ('','$id_apd','$nip','$tgl','$jumlah_permintaan','Belum Disetujui','Belum Disetujui')") or die(mysqli_error());
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

if ($bs['status_permintaan'] == 'Belum Disetujui') {
  echo "<script type='text/javascript'>
  $(window).on('load',function(){
    $('#waiting').modal('show');
    });
    </script>";
}

if ($t['notif'] == 'Ditolak') {
  echo "<script type='text/javascript'>
  $(window).on('load',function(){
    $('#ditolak').modal('show');
    });
    </script>";

  mysqli_query($conn, "UPDATE permintaan SET notif= '-' WHERE nip_karyawan='$nip'") or die(mysqli_error());
}

if ($t['notif'] == 'Disetujui') {
  echo "<script type='text/javascript'>
  $(window).on('load',function(){
    $('#disetujui').modal('show');
    });
    </script>";

  mysqli_query($conn, "UPDATE permintaan SET notif= '-' WHERE nip_karyawan='$nip'") or die(mysqli_error());
}
?>

</body>
</html>