<?php
session_start();
require 'db.php';

// Cek login
if (!isset($_SESSION["user"])) {
  header("Location: login.php");
  exit;
}

$user = $_SESSION["user"];
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>📰 News Portal</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/21/21601.png" type="image/png">
</head>


<body class="bg-dark text-light">

<!-- 🔹 NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-black border-bottom border-secondary sticky-top shadow-sm">
  <div class="container-fluid px-4">
    <a class="navbar-brand fw-bold text-warning fs-3" href="#">🗞️ News Portal</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto ms-3">
        <li class="nav-item"><a href="#" class="nav-link category" data-cat="general">General</a></li>
        <li class="nav-item"><a href="#" class="nav-link category" data-cat="business">Business</a></li>
        <li class="nav-item"><a href="#" class="nav-link category" data-cat="technology">Technology</a></li>
        <li class="nav-item"><a href="#" class="nav-link category" data-cat="sports">Sports</a></li>
      </ul>

      <form id="search-form" class="d-flex me-3" style="max-width:300px;">
        <input id="search-input" class="form-control me-2 bg-dark border-secondary text-light" type="search" placeholder="Cari berita...">
        <button class="btn btn-outline-warning"><i class="bi bi-search"></i></button>
      </form>

      <!-- 🔸 PROFILE DROPDOWN -->
      <div class="dropdown">
        <button class="btn btn-outline-warning dropdown-toggle fw-semibold" type="button" id="profileMenu" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="bi bi-person-circle"></i> <?= htmlspecialchars($user['username']) ?>
        </button>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark" aria-labelledby="profileMenu">
          <li><a class="dropdown-item" href="bookmark.php"><i class="bi bi-star"></i> Bookmark Saya</a></li>
          <li><a class="dropdown-item" href="account.php"><i class="bi bi-info-circle"></i> Info Akun</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item text-danger" href="logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
        </ul>
      </div>
    </div>
  </div>
</nav>

<!-- 🔹 MAIN CONTENT -->
<section class="container-fluid px-lg-5 px-md-4 px-sm-3 my-4">
  <div id="news-grid" class="row g-4"></div>
</section>

<!-- 🔹 FOOTER -->
<footer class="bg-black text-secondary py-4 mt-5 border-top border-secondary">
  <div class="container text-center">
    <p class="mb-0 small">
      © 2025 News Portal — Stay informed with reliable, real-time news.  
      <br>Powered by <span class="text-warning">NewsAPI.org</span>
    </p>
  </div>
</footer>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>
