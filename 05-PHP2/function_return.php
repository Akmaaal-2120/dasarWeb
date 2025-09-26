<?php
function hitungUmur($thn_lahir, $thn_sekarang){
    $umur = $thn_sekarang - $thn_lahir;
    return $umur;
}
function perkenalan($nama, $salam="Assalamualaikum"){
    echo $salam.", ";
    echo "Perkenalkan, nama saya".$nama."<br/>";
    echo "Umur saya adalah ". hitungUmur(2005, 2023)."Tahun";
    echo "Senang berkenalan dengan anda<br/>"; 

}

perkenalan("Elok");

?>