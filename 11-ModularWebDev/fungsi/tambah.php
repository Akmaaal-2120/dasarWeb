<?php
session_start();

if (!empty($_SESSION['username'])) {
    require '../config/koneksi.php'; 
    require '../fungsi/pesan_kilat.php';


    if (!empty($_GET['jabatan'])) {
        $jabatan = $_POST['jabatan'];
        $keterangan = $_POST['keterangan'];


        $query = "INSERT INTO jabatan (jabatan, keterangan) VALUES ($1, $2)";

        $result = pg_query_params($koneksi, $query, array($jabatan, $keterangan));

        if ($result) {
            pesan('success', "Jabatan Baru Ditambahkan.");
        } else {
    
            $error_message = pg_last_error($koneksi);
            pesan('danger', "Gagal Menambahkan Jabatan. Error: " . $error_message);
        }
        header("Location: ../index.php?page=jabatan");
    }if (!empty($_GET['anggota'])) {
            $username = pg_escape_string($koneksi, $_POST['username']); 
            $password = pg_escape_string($koneksi, $_POST['password']);
            $level = pg_escape_string($koneksi, $_POST['level']);
            $jabatan = pg_escape_string($koneksi, $_POST['jabatan']);
            $nama = pg_escape_string($koneksi, $_POST['nama']);
            $jenis_kelamin = pg_escape_string($koneksi, $_POST['jenis_kelamin']);
            $alamat = pg_escape_string($koneksi, $_POST['alamat']);
            $no_telp = pg_escape_string($koneksi, $_POST['no_telp']);
    
            $salt = bin2hex(random_bytes(16));
            $combined_password = $salt . $password;
            $hashed_password = password_hash($combined_password, PASSWORD_BCRYPT);
    
            // Ubah: Tambahkan RETURNING id untuk mendapatkan ID yang baru di-insert (Asumsi ID kolom user adalah 'id')
            $query = "INSERT INTO users (username, password, salt, level) 
                      VALUES ('$username', '$hashed_password', '$salt', '$level') 
                      RETURNING id";
    
            $result_user = pg_query($koneksi, $query);
    
            if ($result_user) {
                // Perbaikan: Ambil ID terakhir menggunakan pg_fetch_row
                $row_id = pg_fetch_row($result_user);
                $last_id = $row_id[0];
                
                $query2 = "INSERT INTO anggota (nama, jenis_kelamin, alamat, no_telp, user_id, jabatan_id) 
                           VALUES ('$nama', '$jenis_kelamin', '$alamat', '$no_telp', '$last_id', '$jabatan')";
    
                if (pg_query($koneksi, $query2)) {
                    pesan('success', 'Anggota Baru Ditambahkan.');
                } else {
                    pesan('warning', "Gagal Menambahkan Anggota Tetapi Data Login Tersimpan Karena: " . pg_last_error($koneksi));
                }
            } else {
                pesan('danger', "Gagal Menambahkan Anggota Karena: " . pg_last_error($koneksi));
            }
            header("Location: ../index.php?page=anggota");
        }
        
    }


?>