<?php

include '../config.php';

session_start();

// $nama_apd[] = $_POST['nama_apd'];
$nip = $_SESSION['nip'];
$tgl = date("d-m-Y");
// $jumlah[] = $_POST['jumlah'];
// $id_apd[] = $_POST['id_apd'];

// echo $nama_apd[0].'/';
// echo $jumlah[0].'/';
// echo $id_apd[0];

if(!empty($_POST['jumlah'])) {
	foreach ($_POST['jumlah'] as $key => $value2) {
		// echo $value2."<br>";
		if ($value2 !== "") {
			$jumlah[] = $value2;
		}
		
	}
}

if(!empty($_POST['id_apd'])) {
	foreach ($_POST['id_apd'] as $key1 => $value3) {
		// echo $value3."<br>";
		$id[] = $value3;
	}
}


foreach (array_combine($jumlah, $id) as $jumlah => $id_apd) {

	mysqli_query($conn, "INSERT INTO permintaan(id_permintaan, id_apd, nip_karyawan, tanggal_permintaan, jumlah_permintaan) VALUES ('','$id_apd','$nip','$tgl','$jumlah')") or die(mysqli_error());
}

echo "<script>alert('Permintaan berhasil dikirim..')</script>";
echo "<script>location.href='../user';</script>";

// $j = count($jumlah);
// $i = count($id);

// echo $j."<br>";
// echo $i."<br><br>";

// for ($a=0; $a < $j; $a++) { 
// 	echo $jumlah[$a]."<br>";
// }

// // var_dump($jumlah); echo "<br>";

// for ($b=0; $b < $i; $b++) { 
// 	echo $id[$b]."<br>";
// }

// echo $j."<br>";
// echo $i;



// $pieces = explode(' ', $nama_apd);
// $id_apd = array_pop($pieces);

// if (mysqli_query($conn, "INSERT INTO permintaan (id_apd, nip_karyawan, tanggal_permintaan, jumlah_permintaan)
// 	VALUES ('$id_apd', '$nip', '$tgl', '$jumlah')")) {
// 	echo "<script>alert('Permintaan berhasil dikirim..')</script>";
// 	echo "<script>location.href='../user';</script>";
// } else {
// 	echo "<script>alert('Permintaan gagal dikirim..')</script>";
// 	echo "<script>location.href='../user';</script>";
// }

?>