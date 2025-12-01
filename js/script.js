//$apiKey = '404195d841cd4c49966c4e97f1c20355'; // <-- Ganti dengan API kamu
const apiKey = "404195d841cd4c49966c4e97f1c20355";
const apiUrl = "https://newsapi.org/v2/top-headlines?country=us&pageSize=10&apiKey=" + apiKey;

// Fungsi utama
function loadNews(url) {
  $.get(url, function (data) {
    if (data.status !== "ok") return;
    const articles = data.articles;
    let mainHTML = "", sidebarHTML = "";

    // Headline besar
    if (articles.length > 0) {
      const top = articles[0];
        mainHTML += `
        <div class="card mb-4 position-relative">
            <img src="${top.urlToImage || 'https://via.placeholder.com/800x400'}" class="card-img-top" alt="">
            <span class="bookmark-icon" data-title="${top.title}" data-url="${top.url}" data-img="${top.urlToImage || ''}" data-source="${top.source.name}">⭐</span>
            <div class="card-body">
            <h2>${top.title}</h2>
            <p>${top.description || ''}</p>
            <a href="${top.url}" target="_blank" class="btn btn-warning">Baca Selengkapnya</a>
            </div>
        </div>`;
    }

    // Sidebar berita kecil
    for (let i = 1; i < articles.length; i++) {
      const a = articles[i];
        sidebarHTML += `
        <div class="card mb-3 sidebar-card position-relative">
            <div class="row g-0">
            <div class="col-4">
                <img src="${a.urlToImage || 'https://via.placeholder.com/100'}" class="img-fluid rounded-start">
            </div>
            <div class="col-8">
                <div class="card-body p-2">
                <a href="${a.url}" target="_blank" class="text-decoration-none text-light">
                    <h6 class="card-title">${a.title}</h6>
                </a>
                <small class="text-muted">${a.source.name}</small>
                </div>
            </div>
            </div>
            <span class="bookmark-icon" data-title="${a.title}" data-url="${a.url}" data-img="${a.urlToImage || ''}" data-source="${a.source.name}">⭐</span>
        </div>`;
    }
    $("#main-news").html(mainHTML);
    $("#sidebar-news").html(sidebarHTML);
  });
}

$(document).ready(function () {
  loadNews(apiUrl);

  // 🔍 Search
  $("#search-form").on("submit", function (e) {
    e.preventDefault();
    const q = $("#search-input").val();
    if (!q) return;
    loadNews(`https://newsapi.org/v2/everything?q=${q}&pageSize=10&apiKey=${apiKey}`);
  });

  // 🗞️ Kategori
  $(".category").click(function () {
    const cat = $(this).data("cat");
    loadNews(`https://newsapi.org/v2/top-headlines?country=us&category=${cat}&pageSize=10&apiKey=${apiKey}`);
  });

  // 🌗 Mode Switch
  $("#mode-toggle").click(function () {
    $("body").toggleClass("bg-dark text-light bg-light text-dark");
    $(this).text($(this).text() === "🌙" ? "☀️" : "🌙");
  });

  // ⭐ Bookmark
  $(document).on("click", ".bookmark-icon", function () {
    const data = {
      title: $(this).data("title"),
      url: $(this).data("url"),
      img: $(this).data("img"),
      source: $(this).data("source")
    };
    $.post("save_bookmark.php", data, function (res) {
      alert(res);
    });
  });
});
