(function ($) {
  "use strict";

  // baseurl halaman

  const BASE_URL = window.location.origin;

  // declarasi modal admin customers

  const modalAdmin = $("#modal-admin");

  //declarasi form admin customers

  // const form = $("form#form-admin");

  // Tambahkan elemen plusButton setelah elemen .btn-search

  const plusButton = $(
    `<button><img src='/img/admin/icons/plus.svg' width='20px' alt='plus img'><img src='/img/admin/icons/customer.svg' width='20px' alt='ctm img'></button>`,
  ).addClass("btn-add-ctm");

  // Fungsi validasi

  const validateInput = (input, regex, minLength) => {
    const inputValue = input.value.trim(); // Menghapus spasi di awal dan akhir

    const isValid = regex.test(inputValue) && inputValue.length >= minLength;

    input.classList.toggle("is-invalid", !isValid);

    input.classList.toggle("is-valid", isValid);

    return isValid;
  };

  // Cek apakah URL mengarahkan ke /admin/customer

  if (window.location.pathname === "/admin/customer") {
    // Tambahkan elemen plusButton setelah elemen .btn-search

    $(".btn-search").after(plusButton);
  }

  // Fungsi menambahkan elemen

  const buttonAddCtm = $(".btn-add-ctm");

  buttonAddCtm.on("click", function () {
    $("#modal-admin form")[0].reset();

    modalAdmin

      .modal("show")

      .find(".modal-title")

      .html(
        "<img src='/img/admin/icons/customer.svg' width='30px' alt='ctm img' style='filter: invert(60%) hue-rotate(180deg) contrast(400%)';> Tambah Customer",
      );

    // Update form ID and action

    $("#modal-admin form")
      .attr("id", "form-admin-insert")

      .attr("action", BASE_URL + "/coba/insert");

    // Update submit button ID

    $("#modal-admin form .modal-footer button#modal-admin-submit")
      .attr("id", "modal-admin-insert-submit")

      .addClass("btn");

    // Reset form modal admin form

    $("#modal-admin form#form-admin-insert")[0].reset();

    $("#modal-admin form#form-admin-insert")
      .find(".is-valid")

      .removeClass("is-valid");

    // Reset form modal admin form

    $("#modal-admin form#form-admin-insert")
      .find(".is-invalid")

      .removeClass("is-invalid");

    // validasi input tambah customer

    $(document).ready(function () {
      $("#modal-admin form#form-admin-insert #nama").on("input", function () {
        validateInput(this, /^[a-zA-Z\s]+$/, 3);
      });

      $("#modal-admin form#form-admin-insert #no_hp").on("input", function () {
        validateInput(this, /^\d+$/, 11);
      });

      $("#modal-admin form#form-admin-insert #email").on("input", function () {
        validateInput(
          this,
          /[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-z]{2,6}([a-zA-Z0-9_.+-]{1,})/,

          0,
        );
      });
    });

    // row function handle validasi

    const handleValidation = () => {
      // Validasi

      const isValidName = validateInput(
        $("#modal-admin form#form-admin-insert #nama")[0],

        /^[a-zA-Z\s]+$/,

        3,
      );

      const isValidNoHp = validateInput(
        $("#modal-admin form#form-admin-insert #no_hp")[0],

        /^\d+$/,

        11,
      );

      const isValidEmail = validateInput(
        $("#modal-admin form#form-admin-insert #email")[0],

        /[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-z]{2,6}([a-zA-Z0-9_.+-]{1,})/,

        0,
      ); // Mengubah panjang minimal menjadi 0

      if (isValidName && isValidNoHp) {
        // Persiapkan data yang akan dikirim

        const formData = {
          nama: $("#modal-admin form#form-admin-insert #nama").val(),

          no_hp: $("#modal-admin form#form-admin-insert #no_hp").val(),

          email: $("#modal-admin form#form-admin-insert #email").val(),
        };

        // Kirim data dengan metode POST menggunakan AJAX

        $.ajax({
          url: "/admin/customer/insert",

          type: "POST",

          data: formData,

          dataType: "json",

          success: function (response) {
            console.log(response);

            if (response.status == 200) {
              Swal.fire({
                icon: "success",

                title: response.message,

                showConfirmButton: false,

                timer: 1500,
              });

              // Reset formulir

              $("#modal-admin form")[0].reset();

              $("#modal-admin form#form-admin-insert")[0].reset();

              // Menutup modal

              $("#modal-admin").modal("hide");

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
      } else if (!isValidName) {
        Swal.fire({
          icon: "warning",

          title: "Oops...",

          text: "Nama isikan Nama dengan benar!",
        });
      } else if (!isValidNoHp) {
        Swal.fire({
          icon: "warning",

          title: "Oops...",

          text: "Isikan No. Hp dengan benar!",
        });
      } else if (isValidEmail === false && $("#email").val() !== "") {
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

    // MODAL SUBMIT BUTTON

    $("#modal-admin-insert-submit").on("click", function (event) {
      event.preventDefault(); // Mencegah formulir melakukan pengiriman bawaan

      handleValidation();
    });
  });
})(jQuery);
