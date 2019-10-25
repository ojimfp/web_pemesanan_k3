<?php

include '../../config.php';

$id = $_POST['id'];
$nama = $_POST['nama'];

$target = "../../assets/img/";
$gambar = pathinfo($_FILES['gambar']['name'], PATHINFO_FILENAME);
$extension = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
if (isset($_POST['submit'])) {
	
	$check = getimagesize($_FILES["gambar"]["tmp_name"]);

	if ($check !== false) {

		$increment = '';

		while (file_exists($target.$gambar.$increment.'.'.$extension)){
			$increment++;
		}

		$basename = $gambar . $increment . '.' . $extension;

		if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target.$basename)) {
			$qry_id_pengadaan = mysqli_query($conn, "SELECT id_pengadaan FROM pengadaan ORDER BY id_pengadaan DESC LIMIT 1") or die(mysqli_error());
			$id_pengadaan = mysqli_fetch_array($qry_id_pengadaan);
			$id_p = $id_pengadaan['id_pengadaan'];
			$tambah = mysqli_query($conn, "INSERT INTO apd (id_apd, nama_apd, gambar_apd) VALUES ('$id', '$nama', '$basename')");

				if ($tambah) {
					mysqli_query($conn, "INSERT INTO stock(id_apd,jumlah_stock,id_pengadaan) VALUES ('$id',0,'$id_p')");
					echo "<script>alert('Data berhasil ditambah.')</script>";
					echo "<script>location.href='../tambah_apd';</script>";
				} else{
					echo "<script>alert('Data gagal ditambah. ID apd sudah ada dalam database.')</script>";
					echo "<script>location.href='../tambah_apd';</script>";
				}
		} else {
			echo "<script>alert('Data gagal ditambah, ulangi lagi.')</script>";
			echo "<script>location.href='../tambah_apd';</script>";
		}
	} else {
		echo "<script>alert('File bukan gambar, gagal upload, ulangi lagi.')</script>";
		echo "<script>location.href='../tambah_apd';</script>";
	}
}

?>