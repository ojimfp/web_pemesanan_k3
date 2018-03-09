<!-- ini kode buat fungsi login user -->
<?php 
include '../config.php';

 // waktu input username tadi, inputannya ditangkep disini
$username = $_POST['username'];
 // $password = md5($_POST['password']);

 //waktu input password adi, inputannya ditangkep disini
$password = $_POST['password'];

 // cek apakah inputan username password sama dengan yang di database
$login = mysqli_query($conn, "select * from user where username='$username' and password='$password'");
$cek = mysqli_num_rows($login);

if ($cek > 0) {
	while($row = mysqli_fetch_assoc($login)){   

 //kalo username password sesuai sama yang di database, maka buka halaman home user
		if($cek > 0 && $row['id_karyawan']=='1'){
			session_start();
			$_SESSION['username'] = $username;
			$_SESSION['status'] = "login admin";
			header("location:../admin");
 //kalo username password tidak sesuai sama yang di database, maka akan kembali ke halaman login	
		}elseif($cek > 0 && $row['id_karyawan']!='1') {
			session_start();
			$_SESSION['username'] = $username;
			$_SESSION['status'] = "login".$username."";
			header("location:../user");
	// header("location:../dashboard/index.php");
		}
	}
} else {
	 // header("location:index.php");	
	echo "<script>alert('Username atau password salah!!')</script>";
	echo "<script>location.href='../login';</script>";	
}

?>

