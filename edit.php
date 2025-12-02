<?php
include 'db.php';
$id = $_GET['id'];
$data = $conn->query("SELECT * FROM user_news WHERE id=$id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image = $_POST['image_url'];
    $conn->query("UPDATE user_news SET title='$title', content='$content', image_url='$image' WHERE id=$id");
    header("Location: index.php");
    exit;
}
?>

<form method="post">
    <input name="title" value="<?= $data['title'] ?>"><br>
    <textarea name="content"><?= $data['content'] ?></textarea><br>
    <input name="image_url" value="<?= $data['image_url'] ?>"><br>
    <button>Simpan</button>
</form>
