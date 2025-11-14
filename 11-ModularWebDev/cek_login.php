<?php
if (session_status() === PHP_SESSION_NONE)
    session_start();

include "config/koneksi.php";
include "fungsi/pesan_kilat.php";
include "fungsi/anti_injection.php";

$username = antiinjection($koneksi, $_POST['username']);
$password = antiinjection($koneksi, $_POST['password']);

$query = "SELECT username, level, salt, password as hashed_password FROM users WHERE username = '$username'";
$result = pg_query($koneksi, $query);
$row = pg_fetch_assoc($result);
pg_close($koneksi);

$salt = $row['salt'];
$hashed_password = $row['hashed_password'];

if ($salt != null && $hashed_password != null) {
    $combined_password = $salt . $password;
    
    if (password_verify($combined_password, $hashed_password)) {
        $_SESSION['username'] = $row['username'];
        $_SESSION['level'] = $row['level'];
        header("Location: index.php");
    } else {
        pesan('danger', "Login gagal. Password Anda Salah.");
        header("Location: login.php");
    }
} else {
    pesan('warning', "Username tidak ditemukan.");
    header("Location: login.php");
}
?>