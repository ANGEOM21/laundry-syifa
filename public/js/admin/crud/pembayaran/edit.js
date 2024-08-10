(function ($) {
  "use strict";

  $(document).on("click", ".btn-edit-bayar", function () {
    // RESET FORM EDIT

    $("#edit_pembayaran form#form-edit_pembayaran")[0].reset();

    // AMBIL DATA ID

    const id = $(this).data("id");

    $("#edit_pembayaran").modal("show");

    // AJAK MENGAMBIL DATA SESUAI DENGAN ID

    $.ajax({
      url: `/admin/pemesanan/detail/edit/${id}`,

      method: "POST",

      success: function (response) {
        var res = jQuery.parseJSON(response);

        $("#edit_pembayaran form#form-edit_pembayaran #id").val(res.id_pld);

        $("#edit_pembayaran form#form-edit_pembayaran #status_bayar").val(
          res.status_bayar_pld,
        );
      },
    });
  });

  //   MASUKAN DATA DARI FORM PEMBAYARAN MODAL KE FORM EDIT

  $(document).on("submit", "#form-edit_pembayaran", function (e) {
    e.preventDefault();

    var formData = new FormData(this);

    formData.append("edit_pembayaran", true);

    $.ajax({
      type: "POST",

      url: "/admin/bayar/edit",

      data: formData,

      cache: false,

      processData: false,

      contentType: false,

      success: function (response) {
        //   console.log(response);

        if (response.status == 200) {
          Swal.fire({
            icon: "success",

            title: response.message,

            showConfirmButton: false,

            timer: 1800,
          });

          // Reset formulir

          $("#edit_pembayaran form#form-edit_pembayaran")[0].reset();

          // Menutup modal

          $("#edit_pembayaran").modal("hide");

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
        //   console.log(error.responseText);

        Swal.fire({
          icon: "error",

          title: "Oops...",

          text: "Gagal mengirim data!",
        });
      },
    });
  });
})(jQuery);
