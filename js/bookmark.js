$(document).ready(function () {
  loadBookmarks();

  $("#save-note").click(function () {
    const id = $("#note-id").val();
    const text = $("#note-text").val();
    $.post("bookmark_action.php", { action: "update_note", id: id, note: text }, function (res) {
      if (res.status === "ok") {
        $("#noteModal").modal('hide');
        loadBookmarks();
      }
    }, "json");
  });
});

function loadBookmarks() {
  $.post("bookmark_action.php", { action: "get_all" }, function (res) {
    const container = $("#bookmark-list");
    container.html("");

    if (res.status !== "ok" || res.bookmarks.length === 0) {
      container.html("<p class='text-warning text-center'>Belum ada berita yang disimpan.</p>");
      return;
    }

    res.bookmarks.forEach(b => {
      container.append(`
        <div class="col-md-6 col-lg-4">
          <div class="card bg-dark border-secondary h-100">
            <img src="${b.image}" onerror="this.src='img/default.jpg'" class="card-img-top" alt="img">
            <div class="card-body">
              <h5 class="card-title">${b.title}</h5>
              <p class="card-text text-muted">${b.source}</p>
              <p class="card-text small">${b.note ? "📝 " + b.note : "<i>Belum ada catatan</i>"}</p>
              <a href="${b.url}" target="_blank" class="btn btn-sm btn-warning">Baca</a>
              <button class="btn btn-sm btn-outline-light edit-note" data-id="${b.id}" data-note="${b.note}"><i class="bi bi-pencil"></i></button>
              <button class="btn btn-sm btn-outline-danger delete-bookmark" data-id="${b.id}"><i class="bi bi-trash"></i></button>
            </div>
          </div>
        </div>
      `);
    });

    $(".delete-bookmark").click(function () {
      const id = $(this).data("id");
      if (confirm("Hapus berita ini dari bookmark?")) {
        $.post("bookmark_action.php", { action: "delete", id: id }, function () {
          loadBookmarks();
        });
      }
    });

    $(".edit-note").click(function () {
      $("#note-id").val($(this).data("id"));
      $("#note-text").val($(this).data("note"));
      $("#noteModal").modal("show");
    });
  }, "json");
}
