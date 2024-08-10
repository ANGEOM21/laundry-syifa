(function ($) {
  "use strict";

  //   KIRIM EMAIL

  $("#contactForm").on("submit", function (e) {
    e.preventDefault();

    var formData = new FormData(this);

    formData.append("kirim_pesan", true);

    $.ajax({
      type: "POST",

      url: "/send/email",

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

            timer: 2000,
          });

          $("#contactForm")[0].reset();
        } else if (response.status == 400) {
          Swal.fire({
            icon: "warning",

            title: response.message,
          });
        }
      },

      error: function (error) {
        // console.log(error.responseText);

        Swal.fire({
          icon: "error",

          title: "Oops...",

          text: "Gagal mengirim data!",
        });
      },
    });
  });
})(jQuery);
