<?php
include '../koneksi.php';
include '../session.php';
checkLogin();
checkRole('admin');

$id = $_GET['id'];
header("Location: ../proses/lansia_proses.php?aksi=hapus&id=$id");
exit();
?>
