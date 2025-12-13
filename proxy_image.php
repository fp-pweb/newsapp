<?php
if (!isset($_GET['url'])) {
    http_response_code(400);
    exit('URL tidak ditemukan.');
}

$url = $_GET['url'];
$allowed = ['http', 'https'];
$scheme = parse_url($url, PHP_URL_SCHEME);

if (!in_array($scheme, $allowed)) {
    http_response_code(403);
    exit('URL tidak valid.');
}

// Ambil gambar dengan fallback
$context = stream_context_create(['http' => ['timeout' => 5]]);
$image = @file_get_contents($url, false, $context);

if ($image === false) {
    readfile('img/default.jpg');
    exit;
}

// Deteksi jenis konten
$finfo = new finfo(FILEINFO_MIME_TYPE);
$type = $finfo->buffer($image);
header("Content-Type: $type");

echo $image;
?>
