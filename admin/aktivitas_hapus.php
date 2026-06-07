<?php
include '../koneksi.php';
include '../session.php';
checkLogin();

$id = $_GET['id'];
header("Location: ../proses/aktivitas_proses.php?aksi=hapus&id=$id");
exit();
?>
