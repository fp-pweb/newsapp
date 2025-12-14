
# Portal Berita Online

Sistem portal berita berbasis web yang menampilkan berita terkini dari berbagai sumber menggunakan integrasi **NewsAPI.org**.  
Dilengkapi dengan fitur login, register, bookmark, dan tampilan modern yang responsif.

---

## 1. Frontend

### Teknologi
- HTML5, CSS3, JavaScript (jQuery)
- Bootstrap Icons untuk ikon bookmark
- Desain responsif untuk desktop dan mobile

### Fitur Utama
1. **Tampilan Berita Dinamis**  
   - Dua kolom tampilan:
     - Kiri: 2 berita utama besar  
     - Kanan: 4 berita tambahan kecil  
   - Semua berita diambil secara real-time dari NewsAPI.
2. **Pencarian Berita**  
   - Pengguna dapat mencari berita berdasarkan kata kunci.
3. **Kategori Berita**  
   - Filter berita berdasarkan kategori seperti teknologi, bisnis, olahraga, dan lainnya.
4. **Bookmark / Favorit**  
   - Pengguna dapat menandai berita favorit dengan ikon bintang.
5. **Autentikasi Pengguna**  
   - Fitur login dan register dengan tema gradasi ungu-biru modern.
6. **Responsif**  
   - Desain adaptif untuk tampilan di smartphone, tablet, dan desktop.

---

## 2. Backend

### Teknologi
- PHP 8+
- Apache (XAMPP / Laragon)

### Struktur File Utama
| File | Fungsi |
|------|---------|
| `fetch_news.php` | Mengambil berita dari NewsAPI menggunakan cURL |
| `db_connect.php` | Koneksi ke database MySQL |
| `login.php`, `register.php`, `logout.php` | Sistem autentikasi pengguna |
| `proxy_image.php` | (Opsional) Proxy gambar untuk mencegah error CORS |

### Fungsi Utama
- Mengambil dan memfilter berita dari API.
- Menangani registrasi, login, dan logout.
- Mengelola sesi pengguna menggunakan `$_SESSION`.
- Mengamankan password dengan `password_hash()` dan `password_verify()`.

---

## 3. Database

### Teknologi
- MySQL (phpMyAdmin)

### Struktur Tabel

**Tabel: `users`**

| Field | Type | Keterangan |
|--------|------|------------|
| `id` | INT (PK, AI) | ID unik setiap pengguna |
| `username` | VARCHAR(50) | Nama pengguna unik |
| `email` | VARCHAR(100) | Email pengguna |
| `password` | VARCHAR(255) | Password terenkripsi |
| `created_at` | TIMESTAMP | Waktu pembuatan akun |

**SQL Struktur:**
```sql
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  email VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
````

---

## 4. Integrasi API

### API yang Digunakan

* [NewsAPI.org](https://newsapi.org)

**Endpoint:**

* `https://newsapi.org/v2/top-headlines`
* `https://newsapi.org/v2/everything`

### Mekanisme Kerja

1. Frontend melakukan request AJAX ke `fetch_news.php`.
2. `fetch_news.php` meneruskan permintaan ke NewsAPI dengan API key.
3. Response JSON dari API dikembalikan ke frontend.
4. JavaScript menampilkan berita di halaman utama.

### Keamanan

* API Key disimpan di file `.env`:

  ```env
  API_KEY=your_newsapi_key_here
  ```
* Diakses dari PHP:

  ```php
  $env = parse_ini_file(__DIR__ . '/.env');
  $apiKey = $env['API_KEY'];
  ```

---

## 5. Testing

### Jenis Pengujian

| Jenis               | Tujuan                                                  | Hasil    |
| ------------------- | ------------------------------------------------------- | -------- |
| Unit Test (PHP)     | Memastikan koneksi database dan API berfungsi           | Berhasil |
| Functional Test     | Mengecek fitur pencarian, kategori, dan tampilan berita | Berhasil |
| Auth Test           | Menguji registrasi, login, dan logout pengguna          | Berhasil |
| Image Proxy Test    | Memastikan gambar tampil tanpa error CORS               | Berhasil |
| Responsiveness Test | Memastikan tampilan beradaptasi di berbagai perangkat   | Berhasil |

### Browser yang Diuji

* Google Chrome 120+
* Microsoft Edge 120+
* Mozilla Firefox 120+

---

## 6. Diagram System

### Alur Sistem

```
[ Pengguna ]
     │
     ▼
[ Frontend (HTML/CSS/JS) ]
     │  (AJAX Request)
     ▼
[ fetch_news.php (Backend PHP) ]
     │  (cURL Request)
     ▼
[ NewsAPI.org ]
     │  (JSON Response)
     ▼
[ Backend → Filter Data → Kirim JSON ]
     │
     ▼
[ Frontend Render Berita ]
```

### Diagram Login System

```
[ Form Login Pengguna ]
        │
        ▼
 [login.php → db_connect.php]
        │
        ▼
 [Tabel users (MySQL)]
        │
   password_verify()
        │
        ▼
 [Sesi Login Dibuat]
        │
        ▼
 [index.php (Dashboard)]
```

---

## 7. User Guide

### Login dan Register

1. Buka halaman `register.php`.
2. Isi username, email, dan password, lalu klik **Daftar**.
3. Setelah berhasil, sistem akan mengarahkan ke halaman **Login**.
4. Masukkan email dan password, lalu klik **Login**.
5. Pengguna akan diarahkan ke halaman utama (`index.php`).

### Melihat Berita

1. Setelah login, halaman utama menampilkan berita terbaru.
2. Klik kategori di navbar untuk menampilkan berita tertentu.
3. Gunakan kolom pencarian untuk mencari berita berdasarkan kata kunci.
4. Klik gambar atau judul berita untuk membuka artikel di tab baru.

### Bookmark Berita

1. Klik ikon bintang di sudut berita untuk menyimpan ke daftar favorit.
2. Data disimpan di localStorage (browser).
3. Fitur dapat dikembangkan untuk penyimpanan di database.

### Logout

1. Klik tombol **Logout** pada navbar.
2. Sesi pengguna dihapus, dan diarahkan ke halaman login.

---

## Ringkasan

| Komponen     | Teknologi / Tools                               |
| ------------ | ----------------------------------------------- |
| Frontend     | HTML, CSS, JavaScript (jQuery), Bootstrap Icons |
| Backend      | PHP (cURL, Session, password_hash)              |
| Database     | MySQL (phpMyAdmin)                              |
| API          | NewsAPI.org                                     |
| Server Lokal | XAMPP / Laragon                                 |
| Testing      | Browser Console dan Manual Testing              |

---

## Jobdesk

Dikembangkan sebagai proyek portal berita dengan integrasi API menggunakan PHP dan JavaScript.

| Nama     | Tugas                             |
| ------------ | ----------------------------------------------- |
| Muhammad Hafidz Harridil Mahali     | Frontend, Integrasi API, Testing |
| Wahid Badar A      | Backend, Database, Testing             |
| Jhonatan L S     | Testing, Diagram Kerja, Frontend                           |

```
```
