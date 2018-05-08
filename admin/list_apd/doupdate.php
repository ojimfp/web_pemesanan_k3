<?php

include '../../config.php';

$id = $_POST['id'];
$nama = $_POST['nama'];

// var_dump($nip);

if (isset($_POST['submit'])) {
  $target = "../../assets/admin/img/".basename($_FILES['gambar']['name']);
	$gambar = $_FILES['gambar']['name'];
  $update = mysqli_query($conn, "UPDATE apd SET nama_apd = '$nama', gambar_apd = '$gambar' WHERE id_apd = '$id'");

  if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target)) {
	   echo "<script>alert('Data berhasil diupdate.')</script>";
	   echo "<script>location.href='../list_pekerja';</script>";
  } else {
	   echo "<script>alert('Data gagal diupdate, ulangi lagi.')</script>";
	   echo "<script>location.href='../list_pekerja';</script>";
  }
}

?>
