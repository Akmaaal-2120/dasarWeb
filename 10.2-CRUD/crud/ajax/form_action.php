<?php
session_start();
include 'koneksi.php';
include 'csrf.php';

// Sanitasi dan Pengambilan Data POST
$id = stripslashes(strip_tags(htmlspecialchars($_POST['id'], ENT_QUOTES)));
$nama = stripslashes(strip_tags(htmlspecialchars($_POST['nama'], ENT_QUOTES)));
$jenis_kelamin = stripslashes(strip_tags(htmlspecialchars($_POST['jenis_kelamin'], ENT_QUOTES)));
$alamat = stripslashes(strip_tags(htmlspecialchars($_POST['alamat'], ENT_QUOTES)));
$no_telp = stripslashes(strip_tags(htmlspecialchars($_POST['no_telp'], ENT_QUOTES)));

// Logika untuk menentukan apakah INSERT atau UPDATE
if ($id == "") {
    // --- INSERT (Simpan Data Baru) ---
    $query = "INSERT INTO anggota (nama, jenis_kelamin, alamat, no_telp) VALUES (:nama, :jenis_kelamin, :alamat, :no_telp)";
    $sql = $db1->prepare($query);
    
    // Binding parameters
    $sql->bindParam(':nama', $nama);
    $sql->bindParam(':jenis_kelamin', $jenis_kelamin);
    $sql->bindParam(':alamat', $alamat);
    $sql->bindParam(':no_telp', $no_telp);
    
    $sql->execute();

} else {
    // --- UPDATE (Edit Data) ---
    $query = "UPDATE anggota SET nama = :nama, jenis_kelamin = :jenis_kelamin, alamat = :alamat, no_telp = :no_telp WHERE id = :id";
    $sql = $db1->prepare($query);

    // Binding parameters
    $sql->bindParam(':nama', $nama);
    $sql->bindParam(':jenis_kelamin', $jenis_kelamin);
    $sql->bindParam(':alamat', $alamat);
    $sql->bindParam(':no_telp', $no_telp);
    $sql->bindParam(':id', $id, PDO::PARAM_INT); // ID harus diikat sebagai Integer
    
    $sql->execute();
}

echo json_encode(['success' => 'Sukses']); // Respons sukses untuk AJAX

$db1 = null; // Menutup koneksi database
?>