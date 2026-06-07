<?php
include '../koneksi.php';
include '../session.php';
checkLogin();
checkRole('admin');

$aksi = $_GET['aksi'];

if ($aksi == 'tambah') {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama_kategori']);
    $ket = mysqli_real_escape_string($koneksi, $_POST['keterangan']);

    $query = "INSERT INTO kategori_perilaku (nama_kategori, keterangan) VALUES ('$nama', '$ket')";
    
    if (mysqli_query($koneksi, $query)) {
        header("Location: ../admin/kategori_perilaku.php");
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}

if ($aksi == 'edit') {
    $id = $_POST['id_kategori'];
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama_kategori']);
    $ket = mysqli_real_escape_string($koneksi, $_POST['keterangan']);

    $query = "UPDATE kategori_perilaku SET nama_kategori='$nama', keterangan='$ket' WHERE id_kategori='$id'";
    
    if (mysqli_query($koneksi, $query)) {
        header("Location: ../admin/kategori_perilaku.php");
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}

if ($aksi == 'hapus') {
    $id = $_GET['id'];
    mysqli_query($koneksi, "DELETE FROM kategori_perilaku WHERE id_kategori='$id'");
    header("Location: ../admin/kategori_perilaku.php");
}
?>
