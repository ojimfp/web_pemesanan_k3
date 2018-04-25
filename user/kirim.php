<?php

include '../config.php';

session_start();

$nama_apd = $_POST['nama_apd'];
$nip = $_SESSION['nip'];
$tgl = date("d-m-Y");
$jumlah = $_POST['jumlah'];

$pieces = explode(' ', $nama_apd);
$id_apd = array_pop($pieces);

if (mysqli_query($conn, "INSERT INTO permintaan (id_apd, nip_karyawan, tanggal_permintaan, jumlah_permintaan)
	VALUES ('$id_apd', '$nip', '$tgl', '$jumlah')")) {
	echo "<script>alert('Permintaan berhasil dikirim..')</script>";
	echo "<script>location.href='../user';</script>";
} else {
	echo "<script>alert('Permintaan gagal dikirim..')</script>";
	echo "<script>location.href='../user';</script>";
}

?>