<?php
$apiKey = '404195d841cd4c49966c4e97f1c20355'; // <-- Ganti dengan API kamu
$source = 'bbc-news'; // Bisa diganti ke cnn, techcrunch, dll

$url = "https://newsapi.org/v2/top-headlines?sources=$source&apiKey=$apiKey";

$newsData = file_get_contents($url);
echo $newsData;
?>
