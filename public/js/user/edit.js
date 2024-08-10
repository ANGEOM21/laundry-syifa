(function ($) {
  "use strict";

  // EDIT PROFILE USER

  $(document).on("submit", "#form_edit_profile_user", function (e) {
    e.preventDefault();

    var formData = new FormData(this);

    formData.append("edit_profile_user", true);

    // AJAX REQUEST EDIT

    $.ajax({
      type: "POST",

      url: "/user/edit",

      data: formData,

      cache: false,

      processData: false,

      contentType: false,

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

          // load halaman form img

          $("#profile-image-container").load(
            window.location.href + " #profile-image-container",
          );

          $("#editImage").load(window.location.href + " #editImage");
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

  // EDIT GAMBAR USER

  $(".content-edit-user #fileImg").on("change", function () {
    var file = this.files[0];

    var imageUrl = URL.createObjectURL(file);

    $("#image").attr("src", imageUrl);

    $(".content-edit-user #editImage #cancel").show();

    $(".content-edit-user #editImage #confirm").show();

    $(".content-edit-user #editImage #upload").hide();

    $(".content-edit-user #editImage #hapus").hide();
  });

  var userImage = $("#image").attr("src"); // Simpan URL gambar awal

  $(".content-edit-user #editImage #cancel").click(function () {
    $(".content-edit-user #editImage #image").attr("src", userImage); // Kembali ke gambar awal

    $(".content-edit-user #editImage #cancel").hide();

    $(".content-edit-user #editImage #confirm").hide();

    $(".content-edit-user #editImage #upload").show();

    $(".content-edit-user #editImage #hapus").show();
  });

  $(".content-edit-user #editImage #hapus").on("click", function () {
    const id = $(this).data("id");

    var data = {
      userId: id,
    };

    Swal.fire({
      title: "Ingin Menghapus Gambar Ini?",

      icon: "question",

      showCancelButton: true,

      confirmButtonColor: "#03a7cd",

      cancelButtonColor: "#d14d72",

      confirmButtonText: "Yes, delete it!",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "/user/edit/hapus_img",

          data: data,

          type: "POST",

          success: function (response) {
            console.log(response);

            // console.log(response.status);

            if (response.status == 200) {
              Swal.fire({
                icon: "success",

                title: response.message,

                showConfirmButton: false,

                timer: 2000,
              });

              // reload topbar

              $(".img-profile-navbar").load(
                window.location.href + " .img-profile-navbar",
              );

              location.reload();
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
      }
    });
  });

  $(document).on("submit", "#editImage", function (e) {
    e.preventDefault();

    var formData = new FormData(this);

    formData.append("editImage", true);

    // AJAX REQUEST EDIT

    $.ajax({
      type: "POST",

      url: "/user/edit/img",

      data: formData,

      cache: false,

      processData: false,

      contentType: false,

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

          // reload topbar

          $(".img-profile-navbar").load(
            window.location.href + " .img-profile-navbar",
          );

          location.reload();
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
