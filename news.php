<?php
session_start();
require 'env_loader.php';

loadEnv(__DIR__ . '/.env');
$apiKey = getenv('API_KEY');

$title = $_GET['title'] ?? '(Tanpa Judul)';
$desc = $_GET['desc'] ?? '';
$img = $_GET['img'] ?? 'img/default.jpg';
$source = $_GET['source'] ?? 'Tidak diketahui';
$url = $_GET['url'] ?? '#';

$query = urlencode($title);
$apiUrl = "https://newsapi.org/v2/everything?q={$query}&language=id&apiKey={$apiKey}";

$context = stream_context_create([
  "http" => [
    "header" => "User-Agent: NewsPortal/1.0\r\n"
  ]
]);

$response = @file_get_contents($apiUrl, false, $context);
$articleBody = '';

if ($response) {
  $data = json_decode($response, true);
  if (!empty($data['articles'])) {
    $found = $data['articles'][0];
    $articleBody = $found['content'] ?? '(Konten lengkap tidak tersedia.)';
    if ($desc == '') $desc = $found['description'] ?? '';
    if ($img == 'img/default.jpg' && !empty($found['urlToImage'])) $img = $found['urlToImage'];
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($title) ?> | News Portal</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-dark text-light">

<nav class="navbar navbar-dark bg-black border-bottom border-secondary sticky-top px-4">
  <a class="navbar-brand fw-bold text-warning" href="index.php">📰 News Portal</a>
  <a href="javascript:history.back()" class="btn btn-outline-warning btn-sm">
    <i class="bi bi-arrow-left"></i> Kembali
  </a>
</nav>

<div class="container my-5">
  <div class="card bg-dark border-secondary shadow-lg p-4">
    <img src="<?= htmlspecialchars($img) ?>" class="img-fluid rounded mb-4" alt="news-image" style="max-height:400px;object-fit:cover;">

    <h2 class="fw-bold text-warning mb-3"><?= htmlspecialchars($title) ?></h2>

    <?php if ($desc): ?>
      <p class="text-light fs-5"><?= htmlspecialchars($desc) ?></p>
    <?php endif; ?>

    <div class="text-secondary mb-4">
      <small><i class="bi bi-newspaper"></i> Sumber: <?= htmlspecialchars($source) ?></small>
    </div>

    <div class="border-top border-secondary pt-3">
      <p class="fs-6 text-light"><?= nl2br(htmlspecialchars($articleBody)) ?></p>
    </div>

    <?php if ($url && $url !== '#'): ?>
      <div class="text-end mt-4">
        <a href="<?= htmlspecialchars(urldecode($url)) ?>" target="_blank" class="btn btn-warning">
          <i class="bi bi-box-arrow-up-right"></i> Baca di Sumber Asli
        </a>
      </div>
    <?php endif; ?>
  </div>
</div>

<footer class="bg-black text-secondary py-4 mt-5 border-top border-secondary text-center">
  <small>© 2025 News Portal — Ringkasan berita berdasarkan sumber eksternal.</small>
</footer>

</body>
</html>
