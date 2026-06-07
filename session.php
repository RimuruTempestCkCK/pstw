<?php
session_start();

function checkLogin() {
    if (!isset($_SESSION['id_user'])) {
        header("Location: login.php");
        exit();
    }
}

function checkRole($role) {
    if ($_SESSION['role'] !== $role) {
        header("Location: dashboard.php");
        exit();
    }
}
?>
