<?php
$nama = @$_GET['nama']; // tanada @ agar tidak ada peringatan error ketika keynyya kosonh
$usia = @$_GET['usia']; 

echo "Halo {$nama}! Apakah benar anada berusia {$usia} tahun?";
?>