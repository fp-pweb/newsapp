<?php
$host = "localhost";
$user = "root";     // username phpMyAdmin kamu
$pass = "";         // password phpMyAdmin kamu
$db   = "news_db";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}
?>
