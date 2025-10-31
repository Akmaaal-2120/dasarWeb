<?php
session_start();
include 'koneksi.php';
include 'csrf.php';

$id = $_POST['id'];

// Mengambil data anggota berdasarkan ID
$query = "SELECT * FROM anggota WHERE id = :id";
$sql = $db1->prepare($query);

// Binding parameter dengan tipe data integer (PDO::PARAM_INT)
$sql->bindParam(':id', $id, PDO::PARAM_INT);
$sql->execute();

$res1 = $sql->fetchAll(PDO::FETCH_ASSOC);

$h = []; // Inisialisasi array untuk data yang akan dikirim

foreach ($res1 as $row) {
    $h['id'] = $row['id'];
    $h['nama'] = $row['nama'];
    $h['jenis_kelamin'] = $row['jenis_kelamin'];
    $h['alamat'] = $row['alamat'];
    $h['no_telp'] = $row['no_telp'];
}

echo json_encode($h); // Mengirim data sebagai JSON

$db1 = null; // Menutup koneksi database
?>