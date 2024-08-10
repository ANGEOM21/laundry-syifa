(function ($) {
  "use strict";

  const addElementAfter = (element, html) => element.after(html);

  const removeElement = (element) => element.remove();

  if (window.location.pathname === "/admin/customer") {
    $(document).on("click", ".btn-edit_ctm", function () {
      // RESET FORM EDIT

      // $("#edit-customer-modal form#edit-customer-form")[0].reset();

      // AMBIL DATA ID

      const id = $(this).data("id");

      $("#edit-customer-modal").modal("show");

      // AJAK MENGAMBIL DATA SESUAI DENGAN ID

      $.ajax({
        url: `/admin/customer/edit/${id}`,

        method: "POST",

        success: function (response) {
          var res = jQuery.parseJSON(response);

          $("#edit-customer-form #id").val(res.id_tmuld);

          $("#edit-customer-form #nama").val(res.name);

          $("#edit-customer-form #email").val(res.email);

          $("#edit-customer-form #no_hp").val(res.no_hp);
        },
      });
    });

    // SUBMIT FORM EDIT CUSTOMER

    $(document).on("submit", "#edit-customer-form", function (e) {
      e.preventDefault();

      var formData = new FormData(this);

      formData.append("update_customer", true);

      $.ajax({
        type: "POST",

        url: "/admin/customer/edit",

        data: formData,

        cache: false,

        processData: false,

        contentType: false,

        success: function (response) {
          // console.log(response);

          if (response.status == 200) {
            Swal.fire({
              icon: "success",

              title: response.message,

              showConfirmButton: false,

              timer: 1500,
            });

            // Reset formulir

            $("#edit-customer-modal form")[0].reset();

            $("#edit-customer-modal form#edit-customer-form")[0].reset();

            // Menutup modal

            $("#edit-customer-modal").modal("hide");

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
