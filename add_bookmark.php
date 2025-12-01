<?php
include 'db.php';

$title = $_POST['title'];
$source = $_POST['source'];
$url = $_POST['url'];
$image_url = $_POST['image_url'];

$stmt = $conn->prepare("INSERT INTO bookmarks (title, source, url, image_url) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $title, $source, $url, $image_url);
$stmt->execute();

echo "success";
?>
