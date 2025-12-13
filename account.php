<?php
session_start();
require 'db.php';

// Pastikan user sudah login
if (!isset($_SESSION["user"])) {
  header("Location: login.php");
  exit;
}

$user = $_SESSION["user"];
$user_id = $user["id"];

// 🗑️ Hapus akun
if (isset($_POST['delete_account'])) {
  $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
  $stmt->bind_param("i", $user_id);
  if ($stmt->execute()) {
    session_destroy();
    header("Location: register.php?msg=account_deleted");
    exit;
  } else {
    $error = "Gagal menghapus akun.";
  }
}

// 🔐 Ubah password
if (isset($_POST['update_password'])) {
  $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
  $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
  $stmt->bind_param("si", $new_password, $user_id);
  if ($stmt->execute()) {
    $success = "Password berhasil diperbarui!";
  } else {
    $error = "Gagal memperbarui password.";
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>👤 Info Akun | News Portal</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="css/account.css">
</head>
<body class="bg-dark text-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-black border-bottom border-secondary sticky-top">
  <div class="container-fluid px-4">
    <a class="navbar-brand fw-bold text-warning" href="index.php">🗞️ News Portal</a>
    <div>
      <a href="bookmark.php" class="btn btn-warning btn-sm me-2"><i class="bi bi-star-fill"></i> Bookmark</a>
      <a href="logout.php" class="btn btn-outline-danger btn-sm"><i class="bi bi-box-arrow-right"></i> Logout</a>
    </div>
  </div>
</nav>

<div class="container my-5">
  <div class="account-card mx-auto p-4 text-center">
    <i class="bi bi-person-circle display-3 text-warning mb-3"></i>
    <h3 class="fw-bold text-warning">Profil Akun</h3>
    <p class="text-secondary mb-4">Kelola informasi akunmu di bawah ini</p>

    <?php if (!empty($error)): ?>
      <div class="alert alert-danger py-2"><?= $error ?></div>
    <?php endif; ?>
    <?php if (!empty($success)): ?>
      <div class="alert alert-success py-2"><?= $success ?></div>
    <?php endif; ?>

    <div class="text-start mb-4">
      <p><strong>👤 Username:</strong> <?= htmlspecialchars($user["username"]) ?></p>
      <p><strong>📧 Email:</strong> <?= htmlspecialchars($user["email"]) ?></p>
    </div>

    <hr class="border-secondary">

    <h5 class="text-light mt-4 mb-3"><i class="bi bi-shield-lock"></i> Ubah Password</h5>
    <form method="post" class="text-start">
      <div class="form-floating mb-3">
        <input type="password" name="new_password" class="form-control bg-dark text-light border-secondary" placeholder="Password baru" required>
        <label>Password baru</label>
      </div>
      <button type="submit" name="update_password" class="btn btn-warning w-100">Perbarui Password</button>
    </form>

    <hr class="border-secondary my-4">

    <form method="post" onsubmit="return confirm('Yakin ingin menghapus akun ini? Tindakan ini tidak bisa dibatalkan.');">
      <button type="submit" name="delete_account" class="btn btn-danger w-100 fw-bold">
        <i class="bi bi-trash"></i> Hapus Akun
      </button>
    </form>
  </div>
</div>

<footer class="bg-black text-secondary py-4 mt-5 border-top border-secondary text-center">
  <small>© 2025 News Portal — Stay informed and secure.</small>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
