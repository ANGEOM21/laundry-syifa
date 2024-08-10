(function ($) {
  "use strict";

  if (
    window.location.pathname === "/admin/customer/aktif" ||
    window.location.pathname === "/admin/customer/tidakaktif"
  ) {
    $(document).on("click", ".btn-edit-status", function () {
      // RESET FORM EDIT

      $("#edit_aktif form")[0].reset();

      // AMBIL DATA ID

      const id = $(this).data("id");

      $("#edit_aktif").modal("show");

      // AJAK MENGAMBIL DATA SESUAI DENGAN ID

      $.ajax({
        url: `/admin/customer/edit/${id}`,

        method: "POST",

        success: function (response) {
          var res = jQuery.parseJSON(response);

          $("#edit_aktif form #id").val(res.id_tmuld);

          $("#edit_aktif form #status_aktif").val(res.status_deactive_tmuld);
        },
      });
    });

    $(document).on("submit", "#form-edit_status", function (e) {
      e.preventDefault();

      var formData = new FormData(this);

      formData.append("edit_status", true);

      $.ajax({
        type: "POST",

        url: "/admin/customer/edit_status",

        data: formData,

        cache: false,

        processData: false,

        contentType: false,

        success: function (response) {
          if (response.status == 200) {
            Swal.fire({
              icon: "success",

              title: response.message,

              showConfirmButton: false,

              timer: 1500,
            });

            // Reset formulir

            $("#edit_aktif form")[0].reset();

            $("#edit_aktif form#form-edit_status")[0].reset();

            // Menutup modal

            $("#edit_aktif").modal("hide");

            // load tabel

            $("#TableAdmin").load(window.location.href + " #TableAdmin");
          } else if (response.status == 400) {
            Swal.fire({
              icon: "warning",

              title: response.message,
            });
          }
        },

        error: function (error) {
          console.log(error.responseText);

          Swal.fire({
            icon: "error",

            title: "Oops...",

            text: "Gagal mengirim data!",
          });
        },
      });
    });
  }
})(jQuery);
