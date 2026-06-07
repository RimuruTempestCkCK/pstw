<?php
include '../koneksi.php';
include '../session.php';
checkLogin();

$aksi = $_GET['aksi'];

if ($aksi == 'tambah') {
    $nama_lansia = mysqli_real_escape_string($koneksi, $_POST['nama_lansia']);
    $umur = $_POST['umur'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $kondisi_health = mysqli_real_escape_string($koneksi, $_POST['kondisi_health']);
    $status_social = mysqli_real_escape_string($koneksi, $_POST['status_social']);
    
    $foto = "";
    if ($_FILES['foto']['name']) {
        $foto = time() . "_" . $_FILES['foto']['name'];
        move_uploaded_file($_FILES['foto']['tmp_name'], "../uploads/foto_lansia/" . $foto);
    }

    $query = "INSERT INTO lansia (nama_lansia, umur, jenis_kelamin, kondisi_health, status_sosial, foto) 
              VALUES ('$nama_lansia', '$umur', '$jenis_kelamin', '$kondisi_health', '$status_social', '$foto')";
    
    if (mysqli_query($koneksi, $query)) {
        header("Location: ../admin/lansia.php");
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}

if ($aksi == 'edit') {
    $id_lansia = $_POST['id_lansia'];
    $nama_lansia = mysqli_real_escape_string($koneksi, $_POST['nama_lansia']);
    $umur = $_POST['umur'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $kondisi_health = mysqli_real_escape_string($koneksi, $_POST['kondisi_health']);
    $status_social = mysqli_real_escape_string($koneksi, $_POST['status_social']);

    $query = "UPDATE lansia SET nama_lansia='$nama_lansia', umur='$umur', jenis_kelamin='$jenis_kelamin', 
              kondisi_health='$kondisi_health', status_sosial='$status_social'";

    if ($_FILES['foto']['name']) {
        // Hapus foto lama
        $old = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT foto FROM lansia WHERE id_lansia='$id_lansia'"));
        if ($old['foto'] && file_exists("../uploads/foto_lansia/" . $old['foto'])) {
            unlink("../uploads/foto_lansia/" . $old['foto']);
        }

        $foto = time() . "_" . $_FILES['foto']['name'];
        move_uploaded_file($_FILES['foto']['tmp_name'], "../uploads/foto_lansia/" . $foto);
        $query .= ", foto='$foto'";
    }

    $query .= " WHERE id_lansia='$id_lansia'";

    if (mysqli_query($koneksi, $query)) {
        header("Location: ../admin/lansia.php");
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}

if ($aksi == 'hapus') {
    $id_lansia = $_GET['id'];
    
    // Hapus foto
    $old = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT foto FROM lansia WHERE id_lansia='$id_lansia'"));
    if ($old['foto'] && file_exists("../uploads/foto_lansia/" . $old['foto'])) {
        unlink("../uploads/foto_lansia/" . $old['foto']);
    }

    mysqli_query($koneksi, "DELETE FROM lansia WHERE id_lansia='$id_lansia'");
    header("Location: ../admin/lansia.php");
}
?>
