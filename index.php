<?php
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>📰 News Portal Modern</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/21/21601.png" type="image/png">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body class="bg-dark text-light">

<!-- 🔹 HEADER / NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-black border-bottom border-secondary sticky-top">
  <div class="container-fluid px-4">
    <a class="navbar-brand fw-bold fs-3 text-warning" href="#">📰 News Portal</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto ms-3">
        <li class="nav-item"><a href="#" class="nav-link category" data-cat="general">General</a></li>
        <li class="nav-item"><a href="#" class="nav-link category" data-cat="business">Business</a></li>
        <li class="nav-item"><a href="#" class="nav-link category" data-cat="technology">Tech</a></li>
        <li class="nav-item"><a href="#" class="nav-link category" data-cat="sports">Sports</a></li>
      </ul>

      <form id="search-form" class="d-flex me-3" style="max-width:300px;">
        <input id="search-input" class="form-control me-2" type="search" placeholder="Cari berita...">
        <button class="btn btn-warning">Cari</button>
      </form>

      <!-- 🔸 PROFILE DROPDOWN -->
      <div class="dropdown">
        <button class="btn btn-outline-warning dropdown-toggle" type="button" id="profileMenu" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="bi bi-person-circle"></i> Profile
        </button>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark" aria-labelledby="profileMenu">
          <li><a class="dropdown-item" href="bookmark.php"><i class="bi bi-star"></i> Bookmark Saya</a></li>
          <li><a class="dropdown-item" href="#"><i class="bi bi-info-circle"></i> Info Akun</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item text-danger" href="logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
        </ul>
      </div>
    </div>
  </div>
</nav>

<!-- 🔹 MAIN CONTENT -->
<div class="container-fluid my-4 px-lg-5 px-md-4 px-sm-3">
  <div class="row g-4" id="news-grid"></div>
</div>


<!-- 🔹 FOOTER -->
<footer class="bg-black text-secondary py-4 mt-5 border-top border-secondary">
  <div class="container text-center">
    <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus volutpat, massa vitae posuere facilisis, sapien leo sagittis metus, nec ultrices turpis justo in leo.</p>
    <small>© 2025 News Portal. All rights reserved.</small>
  </div>
</footer>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>
