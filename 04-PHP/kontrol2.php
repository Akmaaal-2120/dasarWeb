<?php
$custBuy = 120000;
$afterDiscount = 0;
if ($custBuy > 100000){
    $custBuy = $custBuy * 0.2;
    $afterDiscount = 120000 - $custBuy;
    echo "harga setelah diskon: $custBuy <br>";
    echo "harga yang harus dibayar: $afterDiscount";
}
?>