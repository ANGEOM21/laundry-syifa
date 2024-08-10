(function ($) {
  "use strict";

  if (window.location.pathname === "/admin/customer") {
    $(document).on("click", ".btn-hapus_ctm", function () {
      const id = $(this).data("id");

      console.log(id);

      var data = {
        userId: id,
      };

      Swal.fire({
        title: "Yakin Menghapus Data Customer Ini?",

        icon: "question",

        showCancelButton: true,

        confirmButtonColor: "#03a7cd",

        cancelButtonColor: "#d14d72",

        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: "/admin/customer/hapus",

            data: data,

            type: "POST",

            success: function (response) {
              // console.log(response);

              // console.log(response.status);

              if (response.status == 200) {
                Swal.fire({
                  icon: "success",

                  title: response.message,

                  showConfirmButton: false,

                  timer: 2000,
                });

                $("#TableAdmin").load(window.location.href + " #TableAdmin");
              } else if (response.status == 400) {
                Swal.fire({
                  icon: "warning",

                  title: response.message,
                });
              }
            },

            error: function (error) {
              // console.log(error.responseText);

              Swall.fire({
                icon: "error",

                title: "Oops...",

                text: "Gagal mengirim data!",
              });
            },
          });
        }
      });
    });
  }
})(jQuery); //end use strict

// btn-hapus_adm
