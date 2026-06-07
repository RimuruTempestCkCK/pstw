<?php
include '../koneksi.php';
include '../session.php';
checkLogin();

$aksi = $_GET['aksi'];

if ($aksi == 'tambah') {
    $id_lansia = $_POST['id_lansia'];
    $tanggal = $_POST['tanggal'];
    $aktivitas_fisik = mysqli_real_escape_string($koneksi, $_POST['aktivitas_fisik']);
    $kondisi_emosional = mysqli_real_escape_string($koneksi, $_POST['kondisi_emosional']);
    $interaksi_sosial = mysqli_real_escape_string($koneksi, $_POST['interaksi_sosial']);
    $kehadiran_kegiatan = mysqli_real_escape_string($koneksi, $_POST['kehadiran_kegiatan']);
    $pola_makan = mysqli_real_escape_string($koneksi, $_POST['pola_makan']);
    $kesehatan_harian = mysqli_real_escape_string($koneksi, $_POST['kesehatan_harian']);
    $created_by = $_SESSION['id_user'];

    $query = "INSERT INTO aktivitas_lansia (id_lansia, tanggal, aktivitas_fisik, kondisi_emosional, interaksi_sosial, kehadiran_kegiatan, pola_makan, kesehatan_harian, created_by) 
              VALUES ('$id_lansia', '$tanggal', '$aktivitas_fisik', '$kondisi_emosional', '$interaksi_sosial', '$kehadiran_kegiatan', '$pola_makan', '$kesehatan_harian', '$created_by')";
    
    if (mysqli_query($koneksi, $query)) {
        if ($_SESSION['role'] == 'admin') {
            header("Location: ../admin/aktivitas.php");
        } else {
            header("Location: ../petugas/aktivitas.php");
        }
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}

if ($aksi == 'edit') {
    $id_aktivitas = $_POST['id_aktivitas'];
    $id_lansia = $_POST['id_lansia'];
    $tanggal = $_POST['tanggal'];
    $aktivitas_fisik = mysqli_real_escape_string($koneksi, $_POST['aktivitas_fisik']);
    $kondisi_emosional = mysqli_real_escape_string($koneksi, $_POST['kondisi_emosional']);
    $interaksi_sosial = mysqli_real_escape_string($koneksi, $_POST['interaksi_sosial']);
    $kehadiran_kegiatan = mysqli_real_escape_string($koneksi, $_POST['kehadiran_kegiatan']);
    $pola_makan = mysqli_real_escape_string($koneksi, $_POST['pola_makan']);
    $kesehatan_harian = mysqli_real_escape_string($koneksi, $_POST['kesehatan_harian']);

    $query = "UPDATE aktivitas_lansia SET id_lansia='$id_lansia', tanggal='$tanggal', aktivitas_fisik='$aktivitas_fisik', 
              kondisi_emosional='$kondisi_emosional', interaksi_sosial='$interaksi_sosial', kehadiran_kegiatan='$kehadiran_kegiatan', 
              pola_makan='$pola_makan', kesehatan_harian='$kesehatan_harian' 
              WHERE id_aktivitas='$id_aktivitas'";

    if (mysqli_query($koneksi, $query)) {
        if ($_SESSION['role'] == 'admin') {
            header("Location: ../admin/aktivitas.php");
        } else {
            header("Location: ../petugas/aktivitas.php");
        }
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}

if ($aksi == 'hapus') {
    $id_aktivitas = $_GET['id'];
    mysqli_query($koneksi, "DELETE FROM aktivitas_lansia WHERE id_aktivitas='$id_aktivitas'");
    if ($_SESSION['role'] == 'admin') {
        header("Location: ../admin/aktivitas.php");
    } else {
        header("Location: ../petugas/aktivitas.php");
    }
}
?>
