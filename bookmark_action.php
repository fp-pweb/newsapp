<?php
session_start();
require 'db.php';
header('Content-Type: application/json');

if (!isset($_SESSION['user']) || empty($_SESSION['user']['id'])) {
  echo json_encode(["status" => "error", "message" => "No session user_id"]);
  exit;
}

$user_id = $_SESSION['user']['id'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $action = $_POST["action"] ?? '';

  if ($action === "add") {
    $title = $_POST["title"] ?? '';
    $summary = $_POST["summary"] ?? '';
    $image = $_POST["image"] ?? '';
    $url = $_POST["url"] ?? '';
    $note = $_POST["note"] ?? '';

    $check = $conn->prepare("SELECT id FROM bookmarks WHERE user_id = ? AND url = ?");
    $check->bind_param("is", $user_id, $url);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
      echo json_encode(["status" => "exists", "message" => "Berita sudah dibookmark"]);
      exit;
    }

    $stmt = $conn->prepare("INSERT INTO bookmarks (user_id, title, summary, image, url, note) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssss", $user_id, $title, $summary, $image, $url, $note);

    if ($stmt->execute()) echo json_encode(["status" => "success", "message" => "Bookmark disimpan"]);
    else echo json_encode(["status" => "error", "message" => $stmt->error]);
  }

  if ($action === "update_note") {
    $id = intval($_POST["id"]);
    $note = $_POST["note"] ?? '';
    $stmt = $conn->prepare("UPDATE bookmarks SET note = ? WHERE id = ? AND user_id = ?");
    $stmt->bind_param("sii", $note, $id, $user_id);
    if ($stmt->execute()) echo json_encode(["status" => "success"]);
    else echo json_encode(["status" => "error", "message" => $stmt->error]);
  }

  if ($action === "delete") {
    $id = intval($_POST["id"]);
    $stmt = $conn->prepare("DELETE FROM bookmarks WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $id, $user_id);
    if ($stmt->execute()) echo json_encode(["status" => "success"]);
    else echo json_encode(["status" => "error", "message" => $stmt->error]);
  }
}
?>
