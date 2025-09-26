<?php

function perkenalan($nama, $salam="Assalamualaikum"){
    echo $salam.", ";
    echo "Perkenalkan, nama saya".$nama."<br/>";
    echo "Senang berkenalan dengan anda<br/>"; 
}

//memanggil fungsi
perkenalan("Hamdana", "Hallo");

echo "<hr>";

$saya = "Elok";
$ucapanSalam = "Selamat malam";

//memanggil lagi
perkenalan($saya, $ucapanSalam);
?>