<?php

include '../../config.php';

$nama = $_POST['nama'];
$jeniskelamin = substr($_POST['jenis_kelamin'], 0, 1);
$tgllahir = $_POST['tgllahir'];
$alamat = $_POST['alamat'];
$email = $_POST['email'];
$jabatan = substr($_POST['jabatan'], 0, 8);

// echo $nama;
// echo $jeniskelamin;
// echo $tgllahir;
// echo $alamat;
// echo $email;
// echo $jabatan;

$j = $_POST['jabatan'];

if ($j == "Karyawan Umum") {

	$read_nip = mysqli_query($conn, "SELECT MAX(nip) FROM karyawan WHERE SUBSTRING(nip, 1, 2) = 51 ");

	while ($data = mysqli_fetch_array($read_nip)) {

		$nip_password = $data['MAX(nip)'] + 1;

		if (mysqli_query($conn, "INSERT INTO karyawan (nip, password, nama_karyawan, jenis_kelamin, tgl_lahir, alamat, email, jabatan)
			VALUES ('$nip_password', '$nip_password' ,'$nama', '$jeniskelamin', '$tgllahir', '$alamat', '$email', '$jabatan')")) 
		{
			echo "
			<script>alert('Data berhasil ditambahkan.. \\n\\nNIP : $nip_password \\nPassword : $nip_password')
			</script>";
			echo "<script>location.href='../tambah_pekerja';</script>";
		} else {
			echo "<script>alert('Data gagal ditambah..')</script>";
			echo "<script>location.href='../tambah_pekerja';</script>";
		}

	}

	
} elseif($j == "Karyawan Pabrik"){

	$read_nip2 = mysqli_query($conn, "SELECT MAX(nip) FROM karyawan WHERE SUBSTRING(nip, 1, 2) = 52 ");

	while ($data = mysqli_fetch_array($read_nip2)) {

		$nip_password = $data['MAX(nip)'] + 1;

		if (mysqli_query($conn, "INSERT INTO karyawan (nip, password, nama_karyawan, jenis_kelamin, tgl_lahir, alamat, email, jabatan)
			VALUES ('$nip_password', '$nip_password' ,'$nama', '$jeniskelamin', '$tgllahir', '$alamat', '$email', '$jabatan')")) 
		{
			echo "
			<script>
				alert('Data berhasil ditambah..')
			</script>";
			echo "<script>location.href='../tambah_pekerja';</script>";
		} else {
			echo "<script>alert('Data gagal ditambah..')</script>";
			echo "<script>location.href='../tambah_pekerja';</script>";
		}

	}

}

?>