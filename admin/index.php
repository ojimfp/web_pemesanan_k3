<?php
$base = "http://localhost/inventorymanagement/";

include '../config.php';

session_start();

// cek apakah user telah login, jika belum login maka di alihkan ke halaman login
if($_SESSION['status'] !="login admin"){
    header("location:". $base."login");
}

?>

halaman admin