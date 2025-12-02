$(document).ready(function() {
  // 🔹 Default load (top headlines)
  loadNews("fetch_news.php?type=top-headlines");

  // 🔍 Search
  $("#search-form").on("submit", function(e) {
    e.preventDefault();
    const q = $("#search-input").val().trim();
    if (!q) return;
    loadNews(`fetch_news.php?type=everything&q=${encodeURIComponent(q)}`);
  });

  // 🗞️ Kategori
  $(".category").click(function() {
    const cat = $(this).data("cat");
    loadNews(`fetch_news.php?type=top-headlines&category=${cat}`);
  });
});

function loadNews(url) {
  $.get(url, function(data) {
    if (data.status !== "ok") {
      $("#news-grid").html("<p class='text-warning text-center'>Gagal memuat berita.</p>");
      console.log(data);
      return;
    }

    const validArticles = data.articles.filter(a =>
      a.title && a.url && a.description && a.source && a.source.name
    );

    if (validArticles.length === 0) {
      $("#news-grid").html("<p class='text-warning text-center'>Tidak ada berita valid.</p>");
      return;
    }

    let leftHTML = `<div class="news-column-left">`;
    let rightHTML = `<div class="news-column-right">`;

    // 🔹 2 berita besar di kiri
    for (let i = 0; i < 2 && i < validArticles.length; i++) {
      const a = validArticles[i];
      const img = a.urlToImage || 'img/default.jpg';
      leftHTML += `
        <div class="news-large mb-4">
          <img src="${img}" alt="">
          <div class="news-overlay">
            <h4>${a.title}</h4>
            <p class="small text-muted">${a.source.name}</p>
          </div>
          <span class="bookmark-icon" data-title="${a.title}" data-url="${a.url}" data-img="${img}" data-source="${a.source.name}">
            <i class="bi bi-star"></i>
          </span>
        </div>`;
    }

    leftHTML += `</div>`;

    // 🔹 4 berita kecil di kanan
    for (let i = 2; i < 6 && i < validArticles.length; i++) {
      const a = validArticles[i];
      const img = a.urlToImage || 'img/default.jpg';
      rightHTML += `
        <div class="news-small mb-3">
          <img src="${img}" alt="">
          <div class="news-overlay">
            <h5>${a.title}</h5>
            <small class="text-muted">${a.source.name}</small>
          </div>
          <span class="bookmark-icon" data-title="${a.title}" data-url="${a.url}" data-img="${img}" data-source="${a.source.name}">
            <i class="bi bi-star"></i>
          </span>
        </div>`;
    }

    rightHTML += `</div>`;
    $("#news-grid").html(leftHTML + rightHTML);
  });
}
