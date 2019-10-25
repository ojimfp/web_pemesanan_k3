<?php

include '../../config.php';

$pass_lama = $_POST['pass_lama'];
$pass_baru = $_POST['pass_baru'];
$konf_pass_baru = $_POST['konf_pass_baru'];

$pass = mysqli_query($conn, "SELECT password FROM karyawan WHERE
  password = '$pass_lama'");
$cek = mysqli_num_rows($pass);

if (isset($_POST['submit'])) {
if ($cek) {
  if ($pass_baru == $konf_pass_baru) {
    session_start();
    $nip = $_SESSION['nip'];
    $update = mysqli_query($conn, "UPDATE karyawan SET password='$pass_baru' WHERE
      nip='$nip'");
    if ($update) {
      echo "
			<script>alert('Password berhasil diubah')
			</script>";
			echo "<script>location.href='../index.php';</script>";
    }
  } else {
    echo "<script>alert('Password tidak cocok')</script>";
    echo "<script>location.href='../ganti_password';</script>";
  }
} else {
  echo 'Password lama tidak cocok';
  echo "<script>location.href='../ganti_password';</script>";
}
}

?>
