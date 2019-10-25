<?php

include '../../config.php';

$nip = $_POST['nip'];
$nama = $_POST['nama'];
$email = $_POST['email'];
$tgl_lahir = $_POST['tgl_lahir'];
$alamat = $_POST['alamat'];

$update = "UPDATE karyawan
	SET nama_karyawan = '$nama',
	email = '$email',
	tgl_lahir = '$tgl_lahir',
	alamat = '$alamat'
	WHERE nip = '$nip'";

if (mysqli_query($conn, $update)) {
	echo "<script>alert('Data berhasil diupdate..')</script>";
	echo "<script>location.href='../list_pekerja';</script>";	
} else {
	echo "<script>alert('Data gagal diupdate, ulangi lagi..')</script>";
	echo "<script>location.href='../list_pekerja';</script>";
}

?>