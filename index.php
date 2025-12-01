<?php
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>News Portal</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/21/21601.png" type="image/png">
</head>
<body class="bg-dark text-light" id="body">

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-black border-bottom border-secondary">
  <div class="container-fluid px-4">
    <a class="navbar-brand fw-bold fs-3 text-warning" href="#">📰 News Portal</a>

    <!-- Kategori -->
    <ul class="navbar-nav me-auto ms-3">
      <li class="nav-item"><a href="#" class="nav-link category" data-cat="general">General</a></li>
      <li class="nav-item"><a href="#" class="nav-link category" data-cat="business">Business</a></li>
      <li class="nav-item"><a href="#" class="nav-link category" data-cat="technology">Tech</a></li>
      <li class="nav-item"><a href="#" class="nav-link category" data-cat="health">Health</a></li>
      <li class="nav-item"><a href="#" class="nav-link category" data-cat="sports">Sports</a></li>
    </ul>

    <!-- Search -->
    <form id="search-form" class="d-flex me-3" style="max-width:300px;">
      <input id="search-input" class="form-control me-2" type="search" placeholder="Cari berita...">
      <button class="btn btn-warning">Cari</button>
    </form>

    <!-- Mode Switch -->
    <button class="btn btn-sm btn-outline-light me-2" id="mode-toggle">🌙</button>

    <!-- Auth -->
    <?php if (isset($_SESSION['user'])): ?>
      <a href="bookmark.php" class="btn btn-warning me-2">⭐ Bookmark Saya</a>
      <a href="logout.php" class="btn btn-outline-danger">Logout</a>
    <?php else: ?>
      <a href="login.php" class="btn btn-outline-warning">Login</a>
    <?php endif; ?>
  </div>
</nav>

<!-- MAIN -->
<div class="container my-4">
  <div class="row">
    <div class="col-lg-8" id="main-news"></div>
    <div class="col-lg-4" id="sidebar-news"></div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>
