<?php
date_default_timezone_set("Asia/Jakarta");

// Ganti nilai ini sesuai dengan konfigurasi PostgreSQL Anda
$host = "localhost";
$port = "5432"; // Port default PostgreSQL
$dbname = "prakwebdb";
$user = "postgres"; // User default PostgreSQL
$password = "123"; // Ganti dengan password PG Anda!

$koneksi = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$koneksi) {
    die("Koneksi database gagal: " . pg_last_error());
}
?>