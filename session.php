<?php
session_start();

function checkLogin() {
    global $base_url;
    if (!isset($_SESSION['id_user'])) {
        header("Location: " . $base_url . "login.php");
        exit();
    }
}

function checkRole($role) {
    global $base_url;
    if ($_SESSION['role'] !== $role) {
        header("Location: " . $base_url . "dashboard.php");
        exit();
    }
}
?>
