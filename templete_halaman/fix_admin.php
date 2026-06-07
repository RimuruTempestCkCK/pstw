<?php
include 'koneksi.php';

$pass = password_hash('admin123', PASSWORD_DEFAULT);
$query = "UPDATE users SET password = '$pass' WHERE username = 'admin'";

if (mysqli_query($koneksi, $query)) {
    echo "<h2>Berhasil!</h2>";
    echo "<p>Password admin telah diperbarui menjadi: <b>admin123</b></p>";
    echo "<p><a href='login.php'>Klik di sini untuk Login</a></p>";
} else {
    echo "Error: " . mysqli_error($koneksi);
}

// Hapus file ini setelah digunakan
// unlink(__FILE__);
?>
