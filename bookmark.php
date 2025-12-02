<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bookmark Saya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h2>⭐ Bookmark Saya</h2>
    <a href="index.php" class="btn btn-primary mb-3">⬅ Kembali ke Berita</a>

    <div class="row">
        <?php
        $res = $conn->query("SELECT * FROM bookmarks ORDER BY saved_at DESC");
        while ($row = $res->fetch_assoc()):
        ?>
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="<?= $row['image_url'] ?: 'https://via.placeholder.com/300' ?>" class="card-img-top" alt="">
                <div class="card-body">
                    <h5><?= $row['title'] ?></h5>
                    <p class="small text-muted"><?= $row['source'] ?></p>
                    <a href="<?= $row['url'] ?>" target="_blank" class="btn btn-sm btn-primary">Baca</a>
                    <a href="delete_bookmark.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger mt-2">Hapus</a>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>

</body>
</html>
