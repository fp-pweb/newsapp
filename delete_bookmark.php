<?php
include 'db.php';
$id = $_GET['id'];
$conn->query("DELETE FROM bookmarks WHERE id=$id");
header("Location: bookmark.php");
?>
