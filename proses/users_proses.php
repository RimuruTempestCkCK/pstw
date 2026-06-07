<?php
include '../koneksi.php';
include '../session.php';
checkLogin();
checkRole('admin');

$aksi = $_GET['aksi'];

if ($aksi == 'tambah') {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $query = "INSERT INTO users (nama, username, password, role) VALUES ('$nama', '$username', '$password', '$role')";
    
    if (mysqli_query($koneksi, $query)) {
        header("Location: ../admin/users.php");
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}

if ($aksi == 'edit') {
    $id_user = $_POST['id_user'];
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $role = $_POST['role'];

    $query = "UPDATE users SET nama='$nama', username='$username', role='$role'";
    
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $query .= ", password='$password'";
    }

    $query .= " WHERE id_user='$id_user'";

    if (mysqli_query($koneksi, $query)) {
        header("Location: ../admin/users.php");
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}

if ($aksi == 'hapus') {
    $id_user = $_GET['id'];
    
    // Prevent self-deletion
    if ($id_user == $_SESSION['id_user']) {
        header("Location: ../admin/users.php");
        exit();
    }

    mysqli_query($koneksi, "DELETE FROM users WHERE id_user='$id_user'");
    header("Location: ../admin/users.php");
}
?>
