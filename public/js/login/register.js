(function ($) {
  "use strict";

  const BASE_URL = window.location.origin;

  // VALIDASI INPUT IN REGISTER

  const validateInput = (input, regex, minLength) => {
    const inputValue = input.value.trim(); // Menghapus spasi di awal dan akhir

    const isValid = regex.test(inputValue) && inputValue.length >= minLength;

    // TOGGLING CLASS

    input.classList.toggle("is-invalid", !isValid);

    input.classList.toggle("is-valid", isValid);

    return isValid;
  };

  $(document).ready(function () {
    // LOGIN SHOW MODAL

    $(".sign_up").on("click", function () {
      $("#signUpModal").modal("show");

      $("#signInModal").modal("hide");

      // VALIDASI INPUT NOMER HP

      $("form#register_user .form-group #nomer_hp").on("input", function () {
        validateInput(this, /^\d+$/, 11);
      });

      // VALIDASI INPUT EMAIL

      $("form#register_user .form-group #email_regist").on(
        "input",
        function () {
          validateInput(
            this,

            /[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-z]{2,6}([a-zA-Z0-9_.+-]{1,})/,

            0,
          );
        },
      );

      // VALIDASI INPUT PASSWORD

      $("form#register_user .form-group .d-flex #password").on(
        "input",
        function () {
          validateInput(
            this,

            /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[a-zA-Z0-9]{8,}$/,

            8,
          );
        },
      );

      // VALIDASI INPUT RE-PASSWORD

      $("form#register_user .form-group .d-flex #re_password").on(
        "input",
        function () {
          validateInput(
            this,

            /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[a-zA-Z0-9]{8,}$/,

            8,
          );
        },
      );
    });
  });

  // VALIDASI SUBMIT

  const handleValidation = () => {
    // Validasi

    const isValidPassword = validateInput(
      $("form#register_user .form-group #password")[0],

      /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[a-zA-Z0-9]{8,}$/,

      8,
    );

    const isValidrePassword = validateInput(
      $("form#register_user .form-group #re_password")[0],

      /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[a-zA-Z0-9]{8,}$/,

      8,
    );

    const isValidNoHp = validateInput(
      $("form#register_user .form-group #nomer_hp")[0],

      /^\d+$/,

      11,
    );

    const isValidEmail = validateInput(
      $("form#register_user .form-group #email_regist")[0],

      /[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-z]{2,6}([a-zA-Z0-9_.+-]{1,})/,

      0,
    ); // Mengubah panjang minimal menjadi 0

    if (isValidPassword && isValidrePassword && isValidNoHp && isValidEmail) {
      // Persiapkan data yang akan dikirim

      const formData = {
        email: $("#email_regist").val(),

        no_hp: $("#nomer_hp").val(),

        password: $("#password").val(),

        re_password: $("#re_password").val(),

        // kategori: selectedCategory,
      };

      // Kirim data dengan metode POST menggunakan AJAX

      $.ajax({
        // url: "/coba/insert",

        url: "/register",

        type: "POST",

        data: formData,

        dataType: "json",

        success: function (response) {
          //   console.log(response);

          if (response.status == 200) {
            Swal.fire({
              icon: "success",

              title: response.message,

              showConfirmButton: false,

              timer: 1500,
            });

            // Reset formulir

            $("#register_user")[0].reset();

            $("#signUpModal form")[0].reset();

            // Menutup modal

            $("#signUpModal").modal("hide");

            // menampilkan modal

            $("#signInModal").modal("show");
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
    } else if (!isValidPassword) {
      Swal.fire({
        icon: "warning",

        title: "Oops...",

        text: "Password minimal 8 karakter beserta Huruf!",
      });
    } else if (!isValidrePassword) {
      Swal.fire({
        icon: "warning",

        title: "Oops...",

        text: "Konfirmasi Password minimal 8 karakter beserta Huruf!",
      });
    } else if (!isValidNoHp) {
      Swal.fire({
        icon: "warning",

        title: "Oops...",

        text: "Isikan No. Hp dengan benar!",
      });
    } else if (!isValidEmail) {
      // Tampilkan pesan hanya jika email diisi dan tidak valid

      Swal.fire({
        icon: "warning",

        title: "Oops...",

        text: "Isikan Email dengan benar!",
      });
    } else {
      Swal.fire({
        icon: "error",

        title: "Oops...",

        text: "Tidak ada inputan yang valid!",
      });
    }
  };

  // VALIDASI SUBMIT

  $("#signUpModal form button.register_btn").on("click", function (e) {
    e.preventDefault();

    handleValidation();
  });
})(jQuery);
