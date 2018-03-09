<!-- ini kode buat fungsi login user -->
<?php 
include '../config.php';

 // waktu input username tadi, inputannya ditangkep disini
$username = $_POST['username'];
 // $password = md5($_POST['password']);

 //waktu input password adi, inputannya ditangkep disini
$password = $_POST['password'];

 // cek apakah inputan username password sama dengan yang di database
$login = mysqli_query($conn, 
	"SELECT jabatan.nama_jabatan
	FROM user 
	JOIN karyawan ON (user.id_karyawan = karyawan.id_karyawan)
	JOIN jabatan ON (karyawan.id_jabatan = jabatan.id_jabatan)
	WHERE user.username='$username' and user.password='$password'");
$cek = mysqli_num_rows($login);

if ($cek > 0) {
	while($row = mysqli_fetch_assoc($login)){   
		if($cek > 0 && $row['nama_jabatan']=='admin'){
			session_start();
			$_SESSION['username'] = $username;
			$_SESSION['status'] = "login admin";
			header("location:../admin");
		}elseif($cek > 0 && $row['nama_jabatan']!='admin') {
			session_start();
			$_SESSION['username'] = $username;
			$_SESSION['status'] = "login".$username."";
			header("location:../user");
		}
	}
} else {
	 // header("location:index.php");	
	echo "<script>alert('Username atau password salah!!')</script>";
	echo "<script>location.href='../login';</script>";	
}

?>

