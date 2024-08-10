(function ($) {
  "use strict";

  const BASE_URL = window.location.origin;

  const modalAdmin = $("#modal-admin");

  const form = $("form#form-admin");

  const plusButton = $(
    `<button><img src='/img/admin/icons/plus.svg' width='20px' alt='plus img'><img src='/img/admin/icons/customer.svg' width='20px' alt='ctm img'></button>`,
  ).addClass("btn-add-ctm");

  const addElementAfter = (element, html) => element.after(html);

  const removeElement = (element) => element.remove();

  const validateInput = (input, regex, minLength) => {
    const inputValue = input.value.trim(); // Menghapus spasi di awal dan akhir

    const isValid = regex.test(inputValue) && inputValue.length >= minLength;

    input.classList.toggle("is-invalid", !isValid);

    input.classList.toggle("is-valid", isValid);

    return isValid;
  };

  $("button#close").on("click", function () {
    $("#modal-admin form")[0].reset();

    removeElement($("#kiloan"));

    removeElement($("#satuan"));

    removeElement($("#harga"));
  });

  // Cek apakah URL mengarahkan ke /admin/customer

  if (window.location.pathname === "/admin/customer") {
    // Tambahkan elemen plusButton setelah elemen .btn-search

    $(".btn-search").after(plusButton);
  }

  const buttonAddCtm = $(".btn-add-ctm");

  buttonAddCtm.on("click", function () {
    $("#modal-admin form")[0].reset();

    removeElement($("#kiloan"));

    removeElement($("#satuan"));

    removeElement($("#harga"));

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

    $("#modal-admin form#form-admin-insert")[0].reset();

    $("#modal-admin form#form-admin-insert")
      .find(".is-valid")

      .removeClass("is-valid");

    $("#modal-admin form#form-admin-insert")
      .find(".is-invalid")

      .removeClass("is-invalid");

    // select option tambah

    var kiloan = `

  <div class="col mb-3" id="kiloan">

    <label for="kiloan">Berat Kg</label>

    <input type="number" class="form-control is-valid#" id="berat_kg" name="berat_kg"  placeholder="Kg" required>

  </div>



`;

    var satuan = `

  <div class="col mb-3" id="satuan">

    <label for="satuan">Jenis Satuan</label>

    <input type="satuan" class="form-control is-valid#" id="inpt_satuan" name="inpt_satuan"  placeholder="kemeja, boneka, dll" required>

  </div>`;

    var harga = `

  <div class="col mb-3" id="harga">

    <label for="harga">Harga Satuan</label>

    <input type="number" class="form-control" id="harga_satuan" name="harga_satuan"  placeholder="10000" required>

  </div>`;

    $("#kategori").on("change", function () {
      const selectedValue = $(this).val();

      switch (selectedValue) {
        case "kiloan":
          removeElement($("#kiloan"));

          addElementAfter($("#form-row-2"), kiloan);

          removeElement($("#harga"));

          removeElement($("#satuan"));

          break;

        case "satuan":
          removeElement($("#harga"));

          removeElement($("#satuan"));

          addElementAfter($("#form-row-2"), harga);

          addElementAfter($("#form-row-2"), satuan);

          removeElement($("#kiloan"));

          break;

        case "express":
          removeElement($("#kiloan"));

          removeElement($("#satuan"));

          removeElement($("#harga"));

          break;

        default:
          removeElement($("#kiloan"));

          removeElement($("#satuan"));

          removeElement($("#harga"));

          break;
      }
    });

    $("button[type=reset], button#close").on("click", function () {
      removeElement($("div#kiloan"));

      removeElement($("div#satuan"));

      removeElement($("div#harga"));
    });

    // validasi input tambah customer

    $(document).ready(function () {
      $("#nama").on("input", function () {
        validateInput(this, /^[a-zA-Z\s]+$/, 3);
      });

      $("#no_hp").on("input", function () {
        validateInput(this, /^\d+$/, 11);
      });

      $("#email").on("input", function () {
        validateInput(this, /.+@.+/, 1);
      });
    });

    const handleValidation = () => {
      // Validasi

      const isValidName = validateInput(
        $("#form-admin-insert #nama")[0],
        /^[a-zA-Z\s]+$/,
        3,
      );

      const isValidNoHp = validateInput(
        $("#form-admin-insert #no_hp")[0],
        /^\d+$/,
        11,
      );

      const isValidEmail = validateInput(
        $("#form-admin-insert #email")[0],
        /[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-z]{2,6}([a-zA-Z0-9_.+-]{5,})/,
        0,
      ); // Mengubah panjang minimal menjadi 0

      const selectedCategory = $("#form-admin-insert #kategori").val();

      if (isValidName && isValidNoHp && selectedCategory) {
        // Persiapkan data yang akan dikirim

        const formData = {
          nama: $("#nama").val(),

          no_hp: $("#no_hp").val(),

          email: $("#email").val(),

          kategori: selectedCategory,
        };

        // // jika kategori pilihan nya kiloan dsan satuan

        if (selectedCategory === "kiloan") {
          formData.kiloan = $("#form-admin-insert #berat_kg").val();
        } else if (selectedCategory === "satuan") {
          formData.satuan = $("#form-admin-insert #inpt_satuan").val();

          formData.harga = $("#form-admin-insert #harga_satuan").val();
        }

        // console.log(formData);

        // Kirim data dengan metode POST menggunakan AJAX

        $.ajax({
          // url: "/coba/insert",

          url: "/admin/customer/insert",

          type: "POST",

          data: formData,

          dataType: "json",

          success: function (response) {
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
      } else if (!selectedCategory) {
        Swal.fire({
          icon: "warning",

          title: "Oops...",

          text: "Pilih kategori terlebih dahulu!",
        });
      } else {
        Swal.fire({
          icon: "error",

          title: "Oops...",

          text: "Tidak ada inputan yang valid!",
        });
      }
    };

    $("#modal-admin-insert-submit").on("click", function (event) {
      event.preventDefault(); // Mencegah formulir melakukan pengiriman bawaan

      handleValidation();
    });
  });
})(jQuery);
