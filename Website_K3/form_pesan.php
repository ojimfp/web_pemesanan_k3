<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pemesanan Peralatan K3</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="assets/css/form_pesan.css">
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-md">
        <div class="container-fluid">
            <div class="collapse navbar-collapse"
                id="navcol-1">
                <ul class="nav navbar-nav left">
                  <li class="nav-item" role="presentation"><a class="nav-link" href="#">Form Pemesanan</a></li>
                  <li class="nav-item" role="presentation"><a class="nav-link" href="#">Riwayat Pemesanan</a></li>
                </ul>
                <ul class="nav navbar-nav ml-auto">
                  <li class="nav-item" role="presentation"><span class="selamat_datang">Selamat datang, user!</span></li>
                  <li class="nav-item" role="presentation"><a class="nav-link" href="#">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <script>
    function validateForm() {
      var a = document.forms["formPesan"]["helmet"].value;
      var b = document.forms["formPesan"]["earplug"].value;
      var c = document.forms["formPesan"]["baju"].value;
      var d = document.forms["formPesan"]["masker"].value;
      var e = document.forms["formPesan"]["gloves"].value;
      var f = document.forms["formPesan"]["shoes"].value;
      if (a=="" || a==null, b=="" || b==null, c=="" || c==null,
      d=="" || d==null, e=="" || e==null, f=="" || f==null) {
        alert("Isikan jumlah barang yang ingin dipesan.");
        return false;
      } else {
        alert("Pemesanan berhasil!");
      }
    }
    </script>

    <div class="register-photo">
        <div class="form-container">
            <form method="post" name="formPesan" onsubmit="return validateForm()">
                <h2 class="text-center"><strong>Form Pemesanan Peralatan K3</strong></h2>
                <div class="container">
                  <div class="row">
                    <div class="col-md-6">
                    <p>Safety Helmet</p>
                    </div>
                    <div class="col-md-6">
                    <input class="jumlah_barang" type="number" name="helmet" min="1" placeholder="Jumlah" autocomplete="off"/>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                    <p>Earplug</p>
                    </div>
                    <div class="col-md-6">
                    <input class="jumlah_barang" type="number" name="earplug" min="1" placeholder="Jumlah" autocomplete="off"/>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                    <p>Baju Kerja</p>
                    </div>
                    <div class="col-md-6">
                    <input class="jumlah_barang" type="number" name="baju" min="1" placeholder="Jumlah" autocomplete="off"/>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                    <p>Masker</p>
                    </div>
                    <div class="col-md-6">
                    <input class="jumlah_barang" type="number" name="masker" min="1" placeholder="Jumlah" autocomplete="off"/>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                    <p>Safety Gloves</p>
                    </div>
                    <div class="col-md-6">
                    <input class="jumlah_barang" type="number" name="gloves" min="1" placeholder="Jumlah" autocomplete="off"/>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                    <p>Safety Shoes</p>
                    </div>
                    <div class="col-md-6">
                    <input class="jumlah_barang" type="number" name="shoes" min="1" placeholder="Jumlah" autocomplete="off"/>
                    </div>
                  </div>
                </div>
                <div class="form-group"><button class="btn btn-primary btn-block" type="submit">PESAN</button></div>
            </form>
        </div>
    </div>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>

</body>

</html>
