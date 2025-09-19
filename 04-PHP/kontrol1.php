<?php
$grade = [85, 92, 78, 64, 90, 75, 88, 79, 70, 96];
$total = 0;
foreach ($grade as $grades){
    if ($grades == 64 || $grades == 70 || $grades == 96 || $grades == 92){
        continue;
    }
    $total += $grades;
}
echo "Total nilai: $total <br>";
$total = $total / 6;
echo "Rata rata: $total";
?>