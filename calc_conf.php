<!-- ini buat connect ke database nya -->

<?php
// ini nama username dan password untuk connect ke database mysql
$connn = mysqli_connect('localhost','root','');

// ini nama database yang di mysql
mysqli_select_db($connn, 'apd_database_kalkulator'); 
?>