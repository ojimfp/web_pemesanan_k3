<?php 
$base = "http://localhost/inventorymanagement/";

include '../config.php';
// mengaktifkan session
session_start();

// cek apakah user telah login, jika belum login maka di alihkan ke halaman login

$username = $_SESSION['username'];

if($_SESSION['status'] !="login".$username.""){
    header("location:". $base."login");
}
?>

halaman user