<?php
session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $username = trim($_POST["username"]);
  $email = trim($_POST["email"]);
  $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

  $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $username, $email, $password);

  if ($stmt->execute()) {
    header("Location: login.php?msg=registered");
    exit;
  } else {
    $error = "Gagal mendaftar. Coba email lain.";
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar | News Portal</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="css/auth.css">
</head>
<body class="auth-body">

<div class="overlay"></div>

<div class="form-container text-center">
  <h2 class="fw-bold text-warning mb-3"><i class="bi bi-person-plus"></i> Daftar Akun Baru</h2>
  <p class="text-secondary mb-4">Bergabung untuk akses berita eksklusif</p>

  <?php if (!empty($error)) echo "<div class='alert alert-danger py-2'>$error</div>"; ?>

  <form method="post" class="text-start">
    <div class="form-floating mb-3">
      <input type="text" name="username" class="form-control bg-dark text-light border-secondary" placeholder="Username" required>
      <label>Username</label>
    </div>
    <div class="form-floating mb-3">
      <input type="email" name="email" class="form-control bg-dark text-light border-secondary" placeholder="Email" required>
      <label>Email</label>
    </div>
    <div class="form-floating mb-3">
      <input type="password" name="password" class="form-control bg-dark text-light border-secondary" placeholder="Password" required>
      <label>Password</label>
    </div>
    <button type="submit" class="btn btn-warning w-100">Daftar</button>
  </form>

  <p class="mt-3">Sudah punya akun? <a href="login.php" class="text-warning fw-semibold">Login sekarang</a></p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
