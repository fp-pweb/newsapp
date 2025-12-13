<?php
session_start();
require 'db.php';

if (!isset($_SESSION["user"])) {
  header("Location: login.php");
  exit;
}

$user = $_SESSION["user"];
$user_id = $user["id"];

// Ambil bookmark milik user
$query = "SELECT * FROM bookmarks WHERE user_id = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>⭐ Bookmark Saya</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/1828/1828884.png" type="image/png">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body class="bg-dark text-light">

<!-- 🔹 NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-black border-bottom border-secondary sticky-top">
  <div class="container-fluid px-4">
    <a class="navbar-brand fw-bold text-warning" href="index.php">📰 News Portal</a>
    <div>
      <a href="bookmark.php" class="btn btn-warning btn-sm"><i class="bi bi-star-fill"></i> Bookmark</a>
    </div>
  </div>
</nav>

<!-- 🔹 MAIN CONTENT -->
<div class="container my-4">
  <h3 class="mb-4 text-warning"><i class="bi bi-star"></i> Daftar Bookmark Saya</h3>
  <div id="bookmark-list" class="row g-4">
    <?php if ($result->num_rows > 0): ?>
      <?php while($b = $result->fetch_assoc()): ?>
        <div class="col-md-4">
          <div class="card bg-secondary text-light h-100">
            <img src="<?= htmlspecialchars($b['image'] ?: 'https://via.placeholder.com/400x200?text=No+Image') ?>" 
                 class="card-img-top" alt="Thumbnail">
            <div class="card-body">
              <h5 class="card-title"><?= htmlspecialchars($b['title'] ?: '(Tanpa Judul)') ?></h5>
              <p class="card-text small"><?= htmlspecialchars($b['summary'] ?: '(Tanpa ringkasan)') ?></p>
              <?php if (!empty($b['note'])): ?>
                <div class="alert alert-warning py-1 px-2 small">
                  <i class="bi bi-pencil-square"></i> <?= htmlspecialchars($b['note']) ?>
                </div>
              <?php endif; ?>
            </div>
            <div class="card-footer d-flex justify-content-between">
              <a href="<?= htmlspecialchars($b['url']) ?>" class="btn btn-warning btn-sm" target="_blank">Baca</a>
              <div>
                <button class="btn btn-outline-light btn-sm edit-note" 
                        data-id="<?= $b['id'] ?>" 
                        data-note="<?= htmlspecialchars($b['note']) ?>">
                  <i class="bi bi-pencil"></i>
                </button>
                <button class="btn btn-outline-danger btn-sm delete-bookmark" data-id="<?= $b['id'] ?>">
                  <i class="bi bi-trash"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p class="text-center text-secondary mt-5">Belum ada bookmark disimpan.</p>
    <?php endif; ?>
  </div>
</div>

<!-- 🔹 MODAL CATATAN -->
<div class="modal fade" id="noteModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content bg-dark text-light">
      <div class="modal-header">
        <h5 class="modal-title">📝 Catatan untuk Berita</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <textarea id="note-text" class="form-control bg-secondary text-light" rows="4"></textarea>
        <input type="hidden" id="note-id">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-warning" id="save-note">Simpan</button>
      </div>
    </div>
  </div>
</div>

<!-- 🔹 FOOTER -->
<footer class="bg-black text-secondary py-4 mt-5 border-top border-secondary">
  <div class="container text-center">
    <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
    <small>© 2025 News Portal</small>
  </div>
</footer>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
$(function() {
  // 🟡 Edit catatan
  $(".edit-note").click(function() {
    const id = $(this).data("id");
    const note = $(this).data("note") || "";
    $("#note-id").val(id);
    $("#note-text").val(note);
    $("#noteModal").modal("show");
  });

  // 🟡 Simpan catatan
  $("#save-note").click(function() {
    const id = $("#note-id").val();
    const note = $("#note-text").val().trim();

    $.post("bookmark_action.php", { action: "update_note", id: id, note: note }, function(res) {
      if (res.status === "success") {
        alert("Catatan disimpan!");
        location.reload();
      } else {
        alert("Gagal menyimpan catatan: " + res.message);
      }
    }, "json");
  });

  // 🟥 Hapus bookmark
  $(".delete-bookmark").click(function() {
    if (!confirm("Hapus bookmark ini?")) return;
    const id = $(this).data("id");
    $.post("bookmark_action.php", { action: "delete", id: id }, function(res) {
      if (res.status === "success") {
        alert("Bookmark dihapus!");
        location.reload();
      } else {
        alert("Gagal hapus bookmark: " + res.message);
      }
    }, "json");
  });
});
</script>
</body>
</html>
