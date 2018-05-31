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
        <li><a href="#"></a>Permintaan APD</li>
        <li><a href="#">Peminjaman APD</a></li>
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
              Permintaan APD
            </strong>
          </div>
          <div class="panel-body">
            <div class="row">
              <form action="index.php" method="POST">
                <table style="margin: 0 auto;" border="0">
                    <!-- <tr>
                      <th>a</th>
                      <th>b</th>
                      <th>c</th>
                    </tr> -->
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
                            <!-- <input class="form-control" type="hidden" name="id_apd[]" value="<?php echo $data['id_apd']; ?>"> -->
                            <input class="form-control" type="number" name="jumlah[]" placeholder="jumlah permintaan" id="<?php echo $data['id_apd'].'num'; ?>" min="1" style="display:none">
                            <input class="form-control" type="checkbox" name="id_apd[]" value="<?php echo $data['id_apd']; ?>" id="<?php echo $data['id_apd'].'id'; ?>" onclick="<?php echo $data['id_apd'].'()'; ?>">
                            <!-- <p id="<?php echo $data['id_apd'].'text'; ?>" style="display:none">Checkbox is CHECKED!</p> -->
                          </div> 
                          <script> 
                            function <?php echo $data['id_apd'].'()'; ?> {

                              var checkBox = document.getElementById("<?php echo $data['id_apd'].'id'; ?>");
                              var input = document.getElementById("<?php echo $data['id_apd'].'num'; ?>");
                              // var text = document.getElementById("<?php echo $data['id_apd'].'text'; ?>");
                              

                              if (checkBox.checked == true){
                                // text.style.display = "block";
                                // input.hide();
                                input.style.display = "block";
                              } else {
                                input.value = "";
                                input.style.display = "none";
                                // text.style.display = "none";
                              }
                            }

                          </script>

                          <?php 
                          $i++;
                          if ($i%3 == 0) {
                            echo '</td></tr></div><div class="row">';
                          }
                        } ?>
                        <!-- </td>
                        
                      </tr> -->
                </table>
                <div style="text-align: center; vertical-align: middle; margin: 40px auto 30px;">
                  <input class="btn btn-md btn-primary" type="submit" name="submit" value="Ajukan Permintaan">
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>
  </div>

  

  <!-- <div class="container col-lg-5">
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
  </div> -->

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

                <p>1.  Pekerja PG. Kebon Agung hanya diperbolehkan meminta APD yang sesuai dengan ketentuan yang telah ditetapkan perusahaan.</p><br>
                <p>2.  Pekerja wajib membawa bukti bahwa APD yang digunakan benar benar rusak dan tidak dapat digunakan sehingga membutuhkan pergantian.</p><br> 
                <p>3.  Dalam melakukan permintaan APD pekerja wajib mengisi formulir permintaan pada website management inventory.</p><br>
                <p>4.  Setelah mengisi formulir permintaan pekerja datang ke bagian gudang untuk meminta APD yang telah diisi pada form permintaan.</p>

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
          <h4 class="modal-title">BERHASIL!</h4>
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
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">GAGAL!</h4>
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
  
  echo $j.'<br>';
  echo $i.'<br>';

  if ($j = $i && $i > 0 && $j > 0) {
    for ($a=0; $a < $j; $a++) { 
      $jumlah_permintaan = $jumlah[$a];
      $id_apd = $id[$a];

      mysqli_query($conn, "INSERT INTO permintaan(id_permintaan, id_apd, nip_karyawan, tanggal_permintaan, jumlah_permintaan) VALUES ('','$id_apd','$nip','$tgl','$jumlah_permintaan')") or die(mysqli_error());
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
?>

</body>
</html>