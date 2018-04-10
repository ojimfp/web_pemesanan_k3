<!-- ini kode buat fungsi login user -->
<?php 
include '../config.php';

 // waktu input username tadi, inputannya ditangkep disini
$nik = $_POST['nik'];
 // $password = md5($_POST['password']);

 //waktu input password adi, inputannya ditangkep disini
$password = $_POST['password'];

 // cek apakah inputan username password sama dengan yang di database
$login = mysqli_query($conn, 
	"SELECT nik, jabatan, nama_karyawan
	FROM karyawan
	WHERE nik='$nik' and password_karyawan='$password'");
$cek = mysqli_num_rows($login);

if ($cek > 0) {
	while($row = mysqli_fetch_assoc($login)){   
		if($cek > 0 && $row['jabatan']=='Admin'){
			session_start();
			$_SESSION['username'] = $username;
			$_SESSION['status'] = "login admin";
			header("location:../admin");
		}elseif($cek > 0 && $row['jabatan']=='Karyawan') {
			if (substr($row['nik'], 0, 2) == "51") {
				session_start();
				$nama = $row['nama_karyawan'];
				$_SESSION['nik'] = $nik;
				$_SESSION['nama_karyawan'] = $nama;
				$_SESSION['status'] = "login".$nik."";
				$_SESSION['hak_akses'] = "umum";
				header("location:../user");
			} elseif (substr($row['nik'], 0, 2) == "52") {
				session_start();
				$nama = $row['nama_karyawan'];
				$_SESSION['nik'] = $nik;
				$_SESSION['nama_karyawan'] = $nama;
				$_SESSION['status'] = "login".$nik."";
				$_SESSION['hak_akses'] = "pabrik";
				header("location:../user");
			}
		} else {
			echo "<script>alert('Username atau password salah!!')</script>";
			echo "<script>location.href='../login';</script>";
		}
	}
} else {
	 // header("location:index.php");	
	echo "<script>alert('Username atau password salah!!')</script>";
	echo "<script>location.href='../login';</script>";	
}

?>

