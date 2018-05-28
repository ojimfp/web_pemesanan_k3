<?php

include '../../config.php';

$id = $_POST['id'];
$nama = $_POST['nama'];

$target = "../../assets/img/";
$gambar = pathinfo($_FILES['gambar']['name'], PATHINFO_FILENAME);
$extension = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);

// var_dump($gambar);
// var_dump($extension);

if (isset($_POST['submit'])) {
	
	$check = getimagesize($_FILES["gambar"]["tmp_name"]);

	if ($check !== false) {

		$increment = '';

		while (file_exists($target.$gambar.$increment.'.'.$extension)){
			$increment++;
		}

		$basename = $gambar . $increment . '.' . $extension;

		if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target.$basename)) {
			$tambah = mysqli_query($conn, "INSERT INTO apd (id_apd, nama_apd, gambar_apd) VALUES ('$id', '$nama', '$basename')");
			echo "<script>alert('Data berhasil ditambah.')</script>";
			echo "<script>location.href='../tambah_apd';</script>";
			// echo "File is an image - " . $check["mime"] . ".";
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