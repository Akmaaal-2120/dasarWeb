<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST["nama"];
    $email = $_POST["email"];
    $password = $_POST["password"]; // AMBIL INPUT PASSWORD BARU
    $errors = array(); 

    // Validasi Nama
    if (empty($nama)) {
        $errors[] = "Nama harus diisi.";
    }

    // Validasi Email
    if (empty($email)) {
        $errors[] = "Email harus diisi.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak valid.";
    }
    
    // VALIDASI PASSWORD (Minimal 8 Karakter)
    if (empty($password)) {
        $errors[] = "Password harus diisi.";
    } elseif (strlen($password) < 8) {
        $errors[] = "Password minimal 8 karakter.";
    }

    // Jika ada kesalahan validasi
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    } else {
        // Data berhasil dikirim
        echo "Data berhasil dikirim: Nama = $nama, Email = $email, Password telah divalidasi.";
        // Catatan: Dalam aplikasi nyata, password harus di-hash (misalnya, menggunakan password_hash()) sebelum disimpan.
    }
}

?>