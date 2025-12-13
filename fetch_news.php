<?php
// ========================================
// fetch_news.php — proxy server untuk NewsAPI
// ========================================

// Baca API key dari file .env
$env = parse_ini_file(__DIR__ . '/.env');
$apiKey = $env['API_KEY'] ?? null;

if (!$apiKey) {
    echo json_encode(["status" => "error", "message" => "API key tidak ditemukan di .env"]);
    exit;
}

// Ambil parameter dari frontend
$type = $_GET['type'] ?? 'top-headlines';
$query = $_GET['q'] ?? null;
$category = $_GET['category'] ?? null;
$country = $_GET['country'] ?? 'us';
$pageSize = $_GET['pageSize'] ?? 6;

$baseUrl = "https://newsapi.org/v2/";

// Buat URL NewsAPI
if ($type === 'everything' && $query) {
    $url = "{$baseUrl}everything?q=" . urlencode($query) . "&pageSize={$pageSize}&apiKey={$apiKey}";
} else {
    $url = "{$baseUrl}top-headlines?country={$country}&pageSize={$pageSize}&apiKey={$apiKey}";
    if ($category) $url .= "&category=" . urlencode($category);
}

// Gunakan cURL agar stabil dan tambahkan User-Agent
$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_HTTPHEADER => [
        "User-Agent: NewsApp/1.0 (+http://localhost/newsapp)",
        "Accept: application/json"
    ]
]);

$response = curl_exec($ch);
$curlError = curl_error($ch);
curl_close($ch);

// Jika gagal ambil data
if ($response === FALSE || empty($response)) {
    echo json_encode([
        "status" => "error",
        "message" => "Failed to fetch news.",
        "curl_error" => $curlError
    ]);
    exit;
}

// Kirim hasil ke frontend
header('Content-Type: application/json');
echo $response;
?>
