<?php

include '../../config.php';

$id = $_POST['id'];
$nama = $_POST['nama'];

if (isset($_POST['submit'])) {
	$target = "../../assets/admin/img/".basename($_FILES['gambar']['name']);
	$gambar = $_FILES['gambar']['name'];
	$tambah = mysqli_query($conn, "INSERT INTO apd (id_apd, nama_apd, gambar_apd) VALUES ('$id', '$nama', '$gambar')");

	if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target)) {
		echo "<script>alert('Data berhasil ditambah.')</script>";
		echo "<script>location.href='../tambah_apd';</script>";
	} else {
		echo "<script>alert('Data gagal ditambah, ulangi lagi.')</script>";
		echo "<script>location.href='../tambah_apd';</script>";
	}
	// if (getimagesize($_FILES['gambar']['tmp_name'] == FALSE)) {
	// 	echo "Tolong pilih gambar";
	// } else {
	// 	$gambar = addslashes(($_FILES['gambar']['tmp_name']));
	// 	$gambar = file_get_contents($gambar);
	// 	$gambar = base64_encode($gambar);
	//
	// 	if ($tambah) {
	// 		echo "<script>alert('Data berhasil ditambah.')</script>";
	// 		echo "<script>location.href='../tambah_apd';</script>";
	// 	} else {
	// 		echo "<script>alert('Data gagal ditambah, ulangi lagi.')</script>";
	// 		echo "<script>location.href='../tambah_apd';</script>";
	// 	}
	// }
}
// }

?>
