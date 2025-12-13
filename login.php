<?php
session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $login_input = trim($_POST["email"]); // bisa email / username
  $password = $_POST["password"];

  // Cari user berdasarkan email atau username
  $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? OR username = ?");
  $stmt->bind_param("ss", $login_input, $login_input);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    if (password_verify($password, $user["password"])) {
      // Simpan ke session
      $_SESSION["user"] = $user;
      $_SESSION["user_id"] = $user["id"]; // penting agar bookmark & user info bisa jalan
      header("Location: index.php");
      exit;
    } else {
      $error = "Password salah!";
    }
  } else {
    $error = "Username atau email tidak ditemukan!";
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login | News Portal</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="css/auth.css">
</head>
<body class="auth-body">

<div class="overlay"></div>

<div class="form-container text-center">
  <h2 class="fw-bold text-warning mb-3"><i class="bi bi-person-circle"></i> Login Akun</h2>
  <p class="text-secondary mb-4">Masuk untuk membaca berita terbaru</p>
  
  <?php if (!empty($error)) echo "<div class='alert alert-danger py-2'>$error</div>"; ?>

  <form method="post" class="text-start">
    <div class="form-floating mb-3">
      <input type="text" name="email" class="form-control bg-dark text-light border-secondary" placeholder="Email" required>
      <label>Email/Username</label>
    </div>
    <div class="form-floating mb-3">
      <input type="password" name="password" class="form-control bg-dark text-light border-secondary" placeholder="Password" required>
      <label>Password</label>
    </div>
    <button type="submit" class="btn btn-warning w-100">Masuk</button>
  </form>

  <p class="mt-3">Belum punya akun? <a href="register.php" class="text-warning fw-semibold">Daftar di sini</a></p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
