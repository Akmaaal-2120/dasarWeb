<?php

$loremIpsum = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s";

echo "<p>{$loremIpsum}</p>";
echo "Panjang karakter: ".strlen($loremIpsum)."<br";
echo "Panjang kata: ".str_word_count($loremIpsum)."<br";
echo "<p>". strtoupper($loremIpsum)."</p>";
echo "<p>". strtolower($loremIpsum)."</p>";

?>