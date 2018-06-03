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
        <li><a href="index.php">Permintaan APD</a></li>
        <li><a href="#"></a>Peminjaman APD</li>
        <li><a href="ganti_password/index.php">Ganti Password</a></li>
        <p style="float: right;">Welcome <?php echo $nama_karyawan; ?></p>
      </ol>
    </div><!--/.row-->

    <div class="row">
      <div class="col-lg-12">
        <h1 style="text-align: center;" class="page-header"></h1>
      </div>
    </div>
  </div>

  <div class="container col-lg-7">
    <div class="list-group">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <strong>
              Peminjaman APD
            </strong>
          </div>
          <div class="panel-body">
            <div class="row">
              <form action="peminjaman.php" method="POST">
                  <table style="margin: 0 auto;" border="0">
                    <?php 
                    $read_data = mysqli_query($conn, "SELECT * FROM apd") or die(mysqli_error()); ?>
                    <tr>
                    <?php 
                    $i = 0;
                    while ($data = mysqli_fetch_array($read_data)) { ?>
                      <td style="text-align: center; vertical-align: middle;">
                        <div style="margin: 5px;">
                          <img style="width: 90px; margin: 20px 40px 10px;" src="<?php echo $base.'assets/img/'.$data['gambar_apd']; ?>">
                          <strong><p style="text-align: center;"><?php echo $data['nama_apd'].' - '. $data['id_apd']; ?></p></strong>
                          <input class="form-control" type="number" name="jumlah[]" placeholder="jumlah peminjaman" id="<?php echo $data['id_apd'].'num'; ?>" min="1" style="display:none">
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

                    <div class="form-group" style="margin: 40px;">
                      <label>Tanggal Pengembalian</label>
                      <input class="form-control" type="date" name="tanggal" required="">
                    </div>

                <div style="text-align: center; vertical-align: middle; margin: 40px auto 30px;">

                  <?php 
                  $status_belum_disetujui = mysqli_query($conn, "SELECT status_peminjaman FROM peminjaman WHERE nip_karyawan='$nip' and status_peminjaman='Belum Disetujui'") or die(mysqli_error()); 
                  $status_belum_dikembalikan = mysqli_query($conn, "SELECT status_peminjaman FROM peminjaman WHERE nip_karyawan='$nip' and status_peminjaman='Belum Dikembalikan'") or die(mysqli_error()); 
                  $notif = mysqli_query($conn, "SELECT notif FROM peminjaman WHERE nip_karyawan='$nip' ORDER BY tgl_pinjam DESC LIMIT 1") or die(mysqli_error()); 
                  $bs = mysqli_fetch_array($status_belum_disetujui);
                  $bk = mysqli_fetch_array($status_belum_dikembalikan);
                  $t = mysqli_fetch_array($notif);

                  if ($bs['status_peminjaman'] == 'Belum Disetujui') { ?>
                    <input class="btn btn-md btn-primary" type="button" data-toggle="modal" data-target="#waiting" value="Ajukan Peminjaman">
                  <?php } elseif ($bk['status_peminjaman'] == 'Belum Dikembalikan') { ?>
                    <input class="btn btn-md btn-primary" type="button" data-toggle="modal" data-target="#kembalikan" value="Ajukan Peminjaman">
                  <?php } else {?>
                    <input class="btn btn-md btn-primary" type="submit" name="submit" value="Ajukan Peminjaman">
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
              SOP Peminjaman APD
            </strong>
          </div>
          <div class="panel-body">
            <div class="row" style="margin: 10px; ">
             <p>Apabila terdapat tamu perusahaan / tamu direksi pada PG. Kebon Agung apabila membutuhkan safety helmet dapat meminjam langsung di gudang persediaan. Berikut meurupakan SOP peminjaman APD untuk tamu perusahaan : </p>

                <p>1.  Tamu perusahaan / Tamu direksi PG. Kebon Agung diperbolehkan meminjam safety helmet pada gudang perusahaan.</p><br>
                <p>2.  Peminjaman APD dilakukan dengan mengisi formulir peminjaman di website inventory management oleh pekerja/penanggung jawab dari peminjaman.</p><br> 
                <p>3.  Setelah mengisi formulir peminjaman pada website, peminjam datang ke bagian gudang di damping penanggung jawab barang untuk meminta APD yang telah diisi pada form peminjaman pada website.</p><br>
                <p>4.  Apabila telah selesai, maka peminjam wajib mengembalikan APD yang dipinjam dengan kondisi seperti semula.</p>

            </div>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- <div class="panel col-lg-6 col-md-offset-3">
    <div style="height: 300px;" class="row">
      <div style="padding: 20px;">
        <form method="POST" action="kirim.php">
          <h4>Pilih APD</h4>
          <div class="form-group">
            <select name="nama_apd" class="form-control" required="">
              <?php if($hak_akses == "umum") { ?>
              <option>Safety Shoes --- S41</option>
              <option>Safety Shoes --- S42</option>
              <option>Safety Shoes --- S43</option>
              <option>Safety Shoes --- S44</option>
              <option>Safety Helmet --- H001</option>
              <?php } elseif($hak_akses == "pabrik") {
              
              $read_data = mysqli_query($conn, "SELECT id_apd, nama_apd FROM apd") or die(mysqli_error());
              while ($data = mysqli_fetch_array($read_data)) {
              ?>
              <option><?php echo $data['nama_apd'] . " --- " . $data['id_apd']; ?></option>
              <?php } } ?>
            </select>
          </div>
          <h4>Jumlah</h4>
          <div class="form-group">
            <input class="form-control" type="number" name="jumlah" value="1" required="" min="1">
          </div>
          <br><br>
          <input style="width: 100%; " class="btn btn-sm btn-primary" type="submit" name="" value="KIRIM">
        </form>

      </div>
    </div>
  </div> -->

  <div class="modal fade" tabindex="-1" role="dialog" id="success">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title alert alert-success">BERHASIL!</h4>
        </div>
        <div class="modal-body">
          <p>Peminjaman APD telah dikirim..</p>
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
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title alert alert-danger">GAGAL!</h4>
        </div>
        <div class="modal-body">
          <p>Peminjaman APD gagal dikirim, periksa kembali peminjaman anda..</p>
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
          <p>Peminjaman anda sebelumnya belum disetujui, silakan menunggu sampai admin melakukan persetujuan..</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

  <div class="modal fade" tabindex="-1" role="dialog" id="kembalikan">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title alert alert-info">INFORMASI!</h4>
        </div>
        <div class="modal-body">
          <p>Silakan mengembalikan peminjaman anda sebelumnya kepada Admin untuk dapat melakukan peminjaman selanjutnya..</p>
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
          <p>Peminjaman anda sebelumnya ditolak..</p>
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
          <p>Peminjaman anda sebelumnya telah disetujui, silakan mengambil APD pinjaman anda kepada Admin.</p>
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
  
  // echo $j.'<br>';
  // echo $i.'<br>';
  $tgl_k = $_POST['tanggal'];
  $tgl_kembali = date("d-m-Y", strtotime($tgl_k));

  $qry_nip_admin = mysqli_query($conn, "SELECT nip FROM karyawan WHERE jabatan = 'Admin' ORDER BY nip DESC LIMIT 1") or die(mysqli_error());
  $nip_a = mysqli_fetch_array($qry_nip_admin);
  $nip_admin = $nip_a['nip'];

  if ($j == $i && $i > 0 && $j > 0) {
    for ($a=0; $a < $j; $a++) { 
      $jumlah_peminjaman = $jumlah[$a];
      $id_apd = $id[$a];

      mysqli_query($conn, "INSERT INTO `peminjaman`(`nip_karyawan`, `nip_pj`, `id_apd`, `tgl_pinjam`, `tgl_kembali`, `jumlah`, `status_peminjaman`, `notif`) VALUES ('$nip','$nip_admin','$id_apd','$tgl','$tgl_kembali','$jumlah_peminjaman', 'Belum Disetujui', 'Belum Disetujui')") or die(mysqli_error());
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

if ($bs['status_peminjaman'] == 'Belum Disetujui') {
  echo "<script type='text/javascript'>
  $(window).on('load',function(){
    $('#waiting').modal('show');
    });
    </script>";
}

if ($bk['status_peminjaman'] == 'Belum Dikembalikan') {
  echo "<script type='text/javascript'>
  $(window).on('load',function(){
    $('#kembalikan').modal('show');
    });
    </script>";
}

if ($t['notif'] == 'Ditolak') {
  echo "<script type='text/javascript'>
  $(window).on('load',function(){
    $('#ditolak').modal('show');
    });
    </script>";

  mysqli_query($conn, "UPDATE peminjaman SET notif= '-' WHERE nip_karyawan='$nip'") or die(mysqli_error());
}

if ($t['notif'] == 'Belum Dikembalikan') {
  echo "<script type='text/javascript'>
  $(window).on('load',function(){
    $('#disetujui').modal('show');
    });
    </script>";

  mysqli_query($conn, "UPDATE peminjaman SET notif= '-' WHERE nip_karyawan='$nip'") or die(mysqli_error());
}
?>

</body>
</html>