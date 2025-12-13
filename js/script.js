$(document).ready(function () {

  // 📰 Load berita utama
  loadNews("fetch_news.php?type=top-headlines");

  // 🔍 Pencarian
  $("#search-form").on("submit", function (e) {
    e.preventDefault();
    const q = $("#search-input").val().trim();
    if (!q) return;
    loadNews(`fetch_news.php?type=everything&q=${encodeURIComponent(q)}`);
  });

  // 🗞️ Kategori berita
  $(".category").click(function () {
    const cat = $(this).data("cat");
    loadNews(`fetch_news.php?type=top-headlines&category=${cat}`);
  });

});


// ======================================================
// 🔧 FUNCTION: LOAD NEWS
// ======================================================
function loadNews(url) {

  $.get(url, function (data) {

    if (data.status !== "ok") {
      console.error(data);
      $("#news-grid").html(`<p class='text-warning text-center w-100'>Gagal memuat berita.</p>`);
      return;
    }

    // Filter hanya berita dengan data lengkap
    const validArticles = data.articles.filter(a =>
      a.title && a.url && a.description && a.source && a.source.name
    );

    if (validArticles.length === 0) {
      $("#news-grid").html(`<p class='text-warning text-center w-100'>Tidak ada berita valid.</p>`);
      return;
    }

    let leftHTML = `<div class="news-column-left">`;
    let rightHTML = `<div class="news-column-right">`;

    // 🔹 Dua berita besar di kiri
    for (let i = 0; i < 2 && i < validArticles.length; i++) {
      const a = validArticles[i];
      const img = a.urlToImage || 'img/default.jpg';
      leftHTML += `
        <div class="news-large mb-4" data-url="${a.url}">
          <img src="${img}" alt="news-image">
          <div class="news-overlay">
            <h4 class="news-title">${a.title}</h4>
            <p class="news-summary small text-muted">${a.source.name}</p>
          </div>
          <span class="bookmark-icon"><i class="bi bi-star"></i></span>
        </div>`;
    }

    leftHTML += `</div>`;

    // 🔹 Empat berita kecil di kanan
    for (let i = 2; i < 6 && i < validArticles.length; i++) {
      const a = validArticles[i];
      const img = a.urlToImage || 'img/default.jpg';
      rightHTML += `
        <div class="news-small mb-3" data-url="${a.url}">
          <img src="${img}" alt="thumbnail">
          <div class="news-overlay">
            <h5 class="news-title">${a.title}</h5>
            <small class="news-summary text-muted">${a.source.name}</small>
          </div>
          <span class="bookmark-icon"><i class="bi bi-star"></i></span>
        </div>`;
    }

    rightHTML += `</div>`;

    // Masukkan ke halaman
    $("#news-grid").html(leftHTML + rightHTML);

    // 🔸 Aktifkan bookmark setelah konten dimuat
    initBookmarkHandler();

    // 🔸 Aktifkan redirect ke sumber berita
    initNewsRedirect();

  });
}


// ======================================================
// ⭐ FUNCTION: BOOKMARK HANDLER
// ======================================================
function initBookmarkHandler() {
  $(".bookmark-icon").off("click").on("click", function (e) {
    e.preventDefault();
    e.stopPropagation();

    const btn = $(this);
    const card = btn.closest(".news-large, .news-small");

    const title = card.find(".news-title").text().trim();
    const summary = card.find(".news-summary").text().trim();
    const image = card.find("img").attr("src");
    const url = card.data("url");

    // Cegah double bookmark
    if (btn.hasClass("bookmarked")) {
      alert("Berita ini sudah kamu bookmark!");
      return;
    }

    $.ajax({
      url: "bookmark_action.php",
      type: "POST",
      dataType: "json",
      data: {
        action: "add",
        title: title,
        summary: summary,
        image: image,
        url: url
      },
      success: function (res) {
        console.log("Response:", res);
        if (res.status === "success") {
          alert("✅ Bookmark berhasil disimpan!");
          btn.addClass("bookmarked").html('<i class="bi bi-star-fill text-warning"></i>');
        } else if (res.status === "exists") {
          alert("ℹ️ Berita ini sudah ada di bookmark kamu.");
          btn.addClass("bookmarked").html('<i class="bi bi-star-fill text-warning"></i>');
        } else {
          alert("❌ Gagal: " + (res.message || "Terjadi kesalahan"));
        }
      },
      error: function (xhr) {
        alert("❌ Gagal menghubungi server: " + xhr.statusText);
      }
    });
  });
}

// ======================================================
// 🔗 FUNCTION: REDIRECT TO NEWS SOURCE
// ======================================================
function initNewsRedirect() {
  $(".news-large, .news-small").off("click").on("click", function (e) {
    if ($(e.target).closest(".bookmark-icon").length) return;

    const card = $(this);
    const title = encodeURIComponent(card.find(".news-title").text().trim());
    const desc = encodeURIComponent(card.find(".news-summary").text().trim());
    const img = encodeURIComponent(card.find("img").attr("src"));
    const source = encodeURIComponent(card.find(".text-secondary").text().trim());
    const url = encodeURIComponent(card.data("url"));

    // Redirect ke halaman custom dengan data berita
    window.location.href = `news.php?title=${title}&desc=${desc}&img=${img}&source=${source}&url=${url}`;
  });
}

