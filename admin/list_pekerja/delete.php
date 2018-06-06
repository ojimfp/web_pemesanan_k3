<?php

include '../../config.php';

$nip = $_POST['nip'];

$delete = "DELETE FROM karyawan WHERE nip='$nip'";

if (mysqli_query($conn, $delete)) {
	echo "<script>alert('Data berhasil dihapus..')</script>";
	echo "<script>location.href='../list_pekerja';</script>";	
} else {
	echo "<script>alert('Data gagal dihapus, ulangi lagi..')</script>";
	echo "<script>location.href='../list_pekerja';</script>";
}

?>