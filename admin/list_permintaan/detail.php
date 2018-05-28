<?php

include '../../config.php';

$nip = $_POST['nip'];

$data = mysqli_query($conn, "SELECT apd.nama_apd FROM apd JOIN permintaan on permintaan.id_apd = apd.id_apd WHERE permintaan.nip_karyawan = $nip");



?>