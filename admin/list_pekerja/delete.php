<?php

include '../../config.php';

$nik = $_POST['nik'];

// var_dump($nik);

$delete = "DELETE FROM karyawan WHERE nik='$nik'";

if (mysqli_query($conn, $delete)) {
	echo "<script>alert('Data berhasil dihapus..')</script>";
	echo "<script>location.href='../list_pekerja';</script>";	
} else {
	echo "<script>alert('Data gagal dihapus, ulangi lagi..')</script>";
	echo "<script>location.href='../list_pekerja';</script>";
}

?>