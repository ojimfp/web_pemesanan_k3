<?php

include '../../config.php';

$id = $_POST['id'];
$nama = $_POST['nama'];
// $gambar = $_POST['gambar'];

// var_dump($nik);

$tambah = "INSERT INTO apd (id_apd, nama_apd) VALUES ('$id', '$nama');";

if (mysqli_query($conn, $tambah)) {
	echo "<script>alert('Data berhasil ditambah..')</script>";
	echo "<script>location.href='../tambah_apd';</script>";	
} else {
	echo "<script>alert('Data gagal ditambah, ulangi lagi..')</script>";
	echo "<script>location.href='../tambah_apd';</script>";
}

?>